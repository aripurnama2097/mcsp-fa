<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ForgotController extends Controller
{

    public function index(){
    return view('forgot_password.index', [
        "title"=>'forgot',
        "active"=>'login'
    ]);
    } //

}
