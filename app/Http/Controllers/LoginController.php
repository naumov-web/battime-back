<?php

namespace App\Http\Controllers;

use AuthManager;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Login user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials =  $this->request->only('email', 'password');
        $this->validate(
            $this->request,
            ['email'=>'required','password'=>'required']);

        return AuthManager::login($credentials);
    }
}