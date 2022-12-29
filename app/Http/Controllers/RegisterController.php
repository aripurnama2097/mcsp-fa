<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index',[
        "title"=>'Register',
        "active"=>'register'
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name'=>['required', 'min:5', 'max:255','unique:users'],
            'nik'=>'required|max:5',
            'dept'=>'required|max:255',
            'email' =>'required|email:dns|unique:users',
            'password' =>'required|min:5|max:255',  
        ]);

        // $validateData = bcrypt($validateData['password']);

            $validateData['password'] = Hash::make($validateData['password']);
            User::Create($validateData);

            //  $request->session()->flash('success', 'Registration Complete');
             return redirect('/login')->with('success', 'Success! Registration Complete ');
    }
}
