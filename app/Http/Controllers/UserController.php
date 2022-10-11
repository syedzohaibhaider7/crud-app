<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function dashboardView()
    {
        $user = Auth::user();
        $data = ['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'age' => $user->age, 'gender' => $user->gender, 'image' => $user->image];
        return view('user.dashboard', ['data' => $data]);
    }


    public function dashboardPost(Request $request)
    {
        $value = $request->input('user');
        if ($value == "logout") {
            AuthController::logout($request);
            return redirect('/');
        }
    }
}
