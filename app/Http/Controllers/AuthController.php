<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $user = DB::selectOne("SELECT * FROM users WHERE usr_id = ?", [$request->usr]);
        
        if (!$user || !Hash::check($request->psw, $user->usr_psw)) {
            return back()->with('error', 'Invalid credentials');
        }
        
        session(['usr_id' => $user->usr_id, 'usr_type' => $user->usr_type, 'ent_id' => $user->ent_id]);
        
        return redirect('/')->with('success', 'Logged in!');
    }

    public function showRegister()
    {
        return view('auth/register');
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
        }
        DB::beginTransaction();
        try {
            $customerId = DB::table('customers')->insertGetId([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'country' => $request->input('country')
            ]);
            DB::insert("INSERT INTO users (usr_id, ent_id, usr_psw, psw_hint) VALUES (?, ?, ?, ?)", 
            [$request->input('usr'), $customerId, Hash::make($request->input('psw')), $request->input('psw_hint')]);           
            DB::commit();

            return redirect('/login')->with('success', 'Registration complete!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }        
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_type']);
        return redirect('/')->with('success', 'Logged out');
    }
}
