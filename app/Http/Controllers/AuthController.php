<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = DB::selectOne("SELECT * FROM users WHERE usr = ?", [$request->usr]);
        
        if (!$user || !Hash::check($request->psw, $user->usr_psw)) {    //!password_verify($request->psw, $user->pwd)){
            return back()->with('error', 'Invalid credentials');
        }
        $table= (str_ends_with($user->role,'admin') ?'admins' :$user->role .'s');
        $ent= DB::selectOne("SELECT * FROM " .$table." WHERE id = ?", [$user->ent_id]);
        session([
            'auth' => [
                'usr' => $user->usr,
                'ent_id' => $user->ent_id,
                'role' => $ent->role,
                'permissions' => $ent->permissions ?? [],
                'name' => $ent->name
            ]
        ]);
        // Regenerate session for security
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Logged in!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if ($request->input('typ') == 'customer') {
            $request->validate([
                'usr' => 'required|email|unique:users,usr_id',
                'psw' => 'required|string|min:6',
                'psw_hint' => 'required|string|max:100',
                'name' => 'required|string|min:3|max:150',
                'phone' => 'required|regex:regex:/^+?\d{7,15}$/',
                'country' => 'required|integer'
            ]);
        } else{
            return back()->with('error', 'Invalid registration');
        }
        DB::beginTransaction();
        try { 
            $customerId = DB::table('customers')->insertGetId([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'country' => $request->input('country')
            ]);
            DB::insert("INSERT INTO users (usr, psw, ent_id, role, is_active, psw_hint) VALUES (?, ?, ?, ?)", 
            [$request->input('usr'), Hash::make($request->input('psw')), $customerId, 'customer', TRUE, $request->input('psw_hint')]);           
            DB::commit();

            return redirect('/login')->with('success', 'Registration complete!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }        
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
