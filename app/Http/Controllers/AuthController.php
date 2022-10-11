<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function welcomeView()
    {
        return view('auth.welcome');
    }
    public function loginView()
    {
        return view('auth.login');
    }
    public function registerView()
    {
        return view('auth.register');
    }
    public function forgotPasswordView()
    {
        return view('auth.forgot_password');
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
            Mail::send('mail.forgot_pass_mail', $data, function ($message) use ($email) {
                $message->to($email)->subject('Forgot Password?');
                $message->from('sixlogics.ad123@gmail.com', 'Admin');
            });
            return redirect()->route('welcome');
        } else {
            return back()->withErrors(['notRegister' => '(This email is not registered.)'])->onlyInput('notRegister');
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
    public function registerDuplicateCheck(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $nameMatched = User::where('name', '=', $name)->first();
        $emailMatched = User::where('email', '=', $email)->first();
        if (isset($nameMatched) && isset($emailMatched)) {
            $duplicate = "dupBoth";
            return response()->json(['success' => $duplicate]);
        } elseif (isset($nameMatched)) {
            $duplicate = "dupName";
            return response()->json(['success' => $duplicate]);
        } elseif (isset($emailMatched)) {
            $duplicate = "dupEmail";
            return response()->json(['success' => $duplicate]);
        }
    }
    public function register(Request $request)
    {
        $imageName = $request->name . '.' . $request->image->extension();
        $request->file('image')->move(public_path('/images'), $imageName);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->image = $imageName;
        $user->role = 'user';
        $user->save();

        $data = array(
            'name' => $user->name,
            'mail' => $user->email,
            'pass' => $user->password,
            'age' => $user->age,
            'gender' => $user->gender
        );
        $email = $user->email;
        Mail::send('mail.mail', $data, function ($message) use ($email) {
            $message->to($email)->subject('User Added to Database');
            $message->from('sixlogics.ad123@gmail.com', 'Admin');
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user_dash');
    }
    public static function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
