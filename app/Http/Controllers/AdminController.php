<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
 


class AdminController extends Controller
{
    public function index()
    {
       return view('register');
    }

    public function store(Request $request)
    {

        $data = new Admin;
        $hell=$request->validate(
            [
                'username'=>'required|unique:admins',
                'name'=>'required',
                'phone_number'=>'required',
                'email'=>'required|unique:admins',
                'password'=>'required'
            ]
            );
       
        $data->username=$request->username;
        $data->name=$request->name;
        $data->phone_number=$request->phone_number;
        $password =bcrypt($request->password);
         $data->password=$password;
       
        $data->email=$request->email;
        $data->status=true;
        
        $data->save();
        return redirect('register')->with('Success','Admin added successfully');
    }
    
    public function loginpage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
       $data=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
          
        if(Auth::guard('admin')->attempt($data))
        {
         
                return  redirect('products');
    
        }
        else
        {
            if(Admin::where('email',$request->email))
            {
                return redirect('login')->with('message','password is incorrect');
            }
            return redirect('login')->with('message','email is incorrect');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
      
       
    



    
    



