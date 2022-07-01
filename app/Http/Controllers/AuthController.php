<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function welcomeView()
    {
        return view('welcome');
    }
    public function loginView()
    {
        return view('login');
    }
    public function registerView()
    {
        return view('register');
    }
    public function userDashView()
    {
        return view('user_dash');
    }
    public function adminDashView()
    {
        return view('admin_dash');
    }
    public function databaseView()
    {
        $users = User::all();
        return view('database', ['users' => $users]);
    }
    public function welcomePost(Request $request)
    {
        $value = $request->input('user');
        if ($value == "login") {
            return redirect()->route('login');
        } else if ($value == "register") {
            return redirect()->route('register');
        }
    }
    public function adminDashPost(Request $request)
    {
        $value = $request->input('admin');
        if ($value == "logout") {
            $this->logout($request);
            return redirect('/');
        } else if ($value == "database") {
            return redirect()->route('database');
        }
    }
    public function userDashPost(Request $request)
    {
        $value = $request->input('user');
        if ($value == "logout") {
            $this->logout($request);
            return redirect('/');
        }
    }
    public function databasePost(Request $request)
    {
        $value = $request->input('admin');
        if ($value == "dashboard") {
            return redirect()->route('admin_dash');
        }
    }
    public function login(Request $request)
    {
        $user = User::where([
            'name' => $request->name,
            'password' => $request->password
        ])->first();
        
        if($user)
        {
            Auth::login($user);
            $request->session()->regenerate();
            if ($user->role == 'admin')
                return redirect()->route('admin_dash');
            else
                return redirect()->route('user_dash');
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|unique:users|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12',
            'age' => 'required|numeric|min:1|max:100',
            'gender' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->role = 'user';
        $user->save();
        return redirect()->route('user_dash');
    }
    public function logout(Request $request)
    {  
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

}

// $data = array(
        //     'name' => $user->username,
        //     'pass' => $user->passwd,
        //     'mail' => $user->email,
        //     'age' => $user->age,
        //     'gender' => $user->gender
        // );
        // $email = $user->email;
        // Mail::send('mail', $data, function ($message) use ($email) {
        //     $message->to($email)->subject('User Added to Database');
        //     $message->from('syedzohaibhaider70@gmail.com', 'Admin');
        // });

        
        // $name = $request->get('name');
        // $password = $request->get('password');


        // if ((User::where('name', '=', $name)->exists()) && (User::where('password', '=', $password)->exists())) {
        //     $request->session()->put('name', $name);
        //     $request->session()->put('password', $password);
        //     return redirect()->route('user_dash');
        // } else if ((Admin::where('name', '=', $name)->exists()) && (Admin::where('password', '=', $password)->exists())) {
        //     $request->session()->put('name', $name);
        //     $request->session()->put('password', $password);
        //     return redirect()->route('admin_dash');
        // }