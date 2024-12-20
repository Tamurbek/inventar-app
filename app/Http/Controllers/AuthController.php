<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(Request $request){
        $credintels = $request->only('email','password');
        if(Auth::attempt($credintels)){
            $user=Auth::user();
            return redirect()->route('salom')
            ->with(['user_name' => $user->name]);
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function signup(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
