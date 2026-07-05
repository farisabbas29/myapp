<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Registration form
    public function register()
    {
        return view('admin.register');
    }

    // Save admin
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:6'
        ]);

        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('admin.login')
                         ->with('success','Registration successful');
    }

    // Login form
    public function login()
    {
        return view('admin.login');
    }

    // Authenticate admin
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if($admin && Hash::check($request->password,$admin->password))
        {
            session([
                'admin_id'=>$admin->id,
                'admin_name'=>$admin->name
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error','Invalid email or password');
    }

    // Dashboard
    public function dashboard()
    {
        if(!session()->has('admin_id'))
        {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    // Logout
    public function logout()
    {
        session()->forget(['admin_id','admin_name']);

        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email'=>'required|email'
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if(!$admin)
        {
            return back()->with('error','Email not found');
        }

        $token = Str::random(40);

        $admin->reset_token = $token;
        $admin->save();

        // url() = http://localhost/
        $link = url('/reset-password/'.$token);

        // Send Email 

        return back()->with('link',$link);
    }

    public function resetPassword($token)
    {
        $admin = Admin::where('reset_token',$token)->first();

        if(!$admin)
        {
            return redirect()->route('admin.login')
                            ->with('error','Invalid reset link');
        }

        return view('admin.reset-password',compact('token'));
    }


    public function updatePassword(Request $request,$token)
    {
        $request->validate([
            'password'=>'required|min:6'
        ]);

        $admin = Admin::where('reset_token',$token)->first();

        if(!$admin)
        {
            return redirect()->route('admin.login')
                            ->with('error','Invalid token');
        }

        $admin->password = Hash::make($request->password);

        $admin->reset_token = null;

        $admin->save();

        return redirect()->route('admin.login')
                        ->with('success','Password updated successfully');
    }
}


