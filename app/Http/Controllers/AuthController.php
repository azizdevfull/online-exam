<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loadRegister()
    {
        if (Auth::user() && Auth::user()->is_admin ==1) {
            return redirect('/admin/dashboard');
        }
        else if (Auth::user() && Auth::user()->is_admin == 0) {
           return redirect('/dashboard');
        }
        return view('register');
    }
    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your Registration has been successfull.');
    }

    public function loadLogin()
    {
        if (Auth::user() && Auth::user()->is_admin ==1) {
            return redirect('/admin/dashboard');
        }
        else if (Auth::user() && Auth::user()->is_admin == 0) {
           return redirect('/dashboard');
        }
        // else
        // {

        // }
        return view('login');
    }



    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('email', 'password');

        if(Auth::attempt($userCredential)){
            if (Auth::user()->is_admin == 1) {
                return redirect('/admin/dashboard');
            }
            else {
                return redirect('/dashboard');
            }
        }
        else
        {
            return back()->with('error', 'Your Email & Password is invalid.');
        }

    }

    public function loadDashboard()
    {
        return view('student.dashboard');
    }


    public function adminDashboard()
    {
        $subjects = Subject::all(); 
        return view('admin.dashboard', compact('subjects'));
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
