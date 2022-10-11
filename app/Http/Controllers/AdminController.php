<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Spatie\Backtrace\File;

class AdminController extends Controller
{
    public function dashboardView()
    {
        $user = Auth::user();
        $data = ['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'age' => $user->age, 'gender' => $user->gender, 'image' => $user->image];
        return view('admin.dashboard', ['data' => $data]);
    }
    public function addView()
    {
        return view('admin.add');
    }
    public function databaseView()
    {
        $users = User::all();
        return view('admin.database', ['users' => $users]);
    }
    public function editView($id)
    {
        $user = User::all()->where('id', $id)->first();
        return view('admin.edit', ['user' => $user]);
    }


    public function dashboardPost(Request $request)
    {
        $value = $request->input('admin');
        if ($value == "addAdmin") {
            return redirect()->route('add_admin');
        } else if ($value == "database") {
            return redirect()->route('database');
        } else if ($value == "logout") {
            AuthController::logout($request);
            return redirect('/');
        }
    }
    public function addPost(Request $request)
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
        $user->role = 'admin';
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
    public function addDuplicateCheck(Request $request)
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
    public function editDuplicateCheck($id, Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $nameMatched = User::where('name', '=', $name)->where('id', '!=', $id)->first();
        $emailMatched = User::where('email', '=', $email)->where('id', '!=', $id)->first();
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
    public function editPost(Request $request, $id)
    {
        $user = User::all()->where('id', $id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->age = $request->age;
        $user->gender = $request->gender;

        if ($request->image != "") {
            $picture = $user->image;
            unlink(public_path('images/') . $picture);

            $imageName = $request->name . '.' . $request->image->extension();
            $request->file('image')->move(public_path('/images'), $imageName);

            $user->image = $imageName;
        }

        $user->update();

        $data = array(
            'name' => $user->name,
            'mail' => $user->email,
            'pass' => $user->password,
            'age' => $user->age,
            'gender' => $user->gender
        );
        $email = $user->email;
        Mail::send('mail.mail', $data, function ($message) use ($email) {
            $message->to($email)->subject('User Updated in Database');
            $message->from('sixlogics.ad123@gmail.com', 'Admin');
        });

        return redirect()->route('database');
    }
    public function delete($id)
    {
        $user = User::all()->where('id', $id)->first();
        $picture = $user->image;
        unlink(public_path('images/') . $picture);
        $user->delete();
        return redirect()->route('database');
    }
}
