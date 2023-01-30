<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index(){
     
            return view('login.reset_password', [
                "title"=>'Login',
                "active"=>'login'
            ]);
       
    }   



    public function resetPassword(Request $request){

        $user = User::where('email', $request->email)->first();
        if($user) {
            // Update password baru
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Username atau email tidak ditemukan');
        }

    }
   

}
