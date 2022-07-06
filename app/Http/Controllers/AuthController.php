<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user = Auth::user();
        $data = ['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'age' => $user->age, 'gender' => $user->gender];
        return view('user_dash', ['data' => $data]);
    }
    public function adminDashView()
    {
        $user = Auth::user();
        $data = ['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'age' => $user->age, 'gender' => $user->gender];
        return view('admin_dash', ['data' => $data]);
    }
    public function addAdminView()
    {
        return view('add_admin');
    }
    public function databaseView()
    {
        $users = User::all();
        return view('database', ['users' => $users]);
    }
    public function forgotPasswordView()
    {
        return view('forgot_password');
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
        if ($value == "addAdmin") {
            return redirect()->route('add_admin');
        } else if ($value == "database") {
            return redirect()->route('database');
        } else if ($value == "logout") {
            $this->logout($request);
            return redirect('/');
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
    public function addAdminPost(Request $request)
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
        $user->role = 'admin';
        $user->save();

        $data = array(
            'name' => $user->username,
            'mail' => $user->email,
            'pass' => $user->passwd,
            'age' => $user->age,
            'gender' => $user->gender
        );
        $email = $user->email;
        Mail::send('mail', $data, function ($message) use ($email) {
            $message->to($email)->subject('Admin Added to Database');
            $message->from('sixlogics.ad123@gmail.com', 'Admin');
        });

        return redirect()->route('database');
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

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            if ($user->role == 'admin')
                return redirect()->route('admin_dash');
            else
                return redirect()->route('user_dash');
        } else {
            return back()->withErrors(['loginFail' => '(The username or password is incorrect.)'])->onlyInput('loginFail');
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

        $data = array(
            'name' => $user->username,
            'mail' => $user->email,
            'pass' => $user->passwd,
            'age' => $user->age,
            'gender' => $user->gender
        );
        $email = $user->email;
        Mail::send('mail', $data, function ($message) use ($email) {
            $message->to($email)->subject('User Added to Database');
            $message->from('sixlogics.ad123@gmail.com', 'Admin');
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user_dash');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    public function forgotPasswordPost(Request $request)
    {
        $user = User::where([
            'email' => $request->email
        ])->first();

        if ($user) {
            $data = array(
                'name' => $user->name,
                'pass' => $user->password
            );
            $email = $user->email;
            Mail::send('forgot_pass_mail', $data, function ($message) use ($email) {
                $message->to($email)->subject('Forgot Password?');
                $message->from('sixlogics.ad123@gmail.com', 'Admin');
            });
            return redirect()->route('welcome');
        } else {
            return back()->withErrors(['notRegister' => '(This email is not registered.)'])->onlyInput('notRegister');
        }
    }
}
