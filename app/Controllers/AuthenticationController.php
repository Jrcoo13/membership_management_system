<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthenticationController extends BaseController
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
}
