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
        $user = DB::selectOne("SELECT * FROM users WHERE email = ?", [$request->email]);
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }
        
        session(['user_id' => $user->id, 'user_type' => $user->type]);
        
        return redirect('/')->with('success', 'Logged in!');
    }

    public function showRegister()
    {
        return view('auth/register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'type' => 'required|in:customer,supplier'
        ]);
        
        DB::insert("
            INSERT INTO users (name, email, password, type)
            VALUES (?, ?, ?, ?)
        ", [
            $request->name,
            $request->email,
            Hash::make($request->password),
            $request->type
        ]);
        
        return redirect('/login')->with('success', 'Registration complete!');
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_type']);
        return redirect('/')->with('success', 'Logged out');
    }
}
