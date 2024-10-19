<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthenticationController extends BaseController
{
    public function loginView()
    {
        return view('login');
    }
    public function login()
    {
        $userModel = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Find the user by username
        $user = $userModel->where('username', $username)->first(); // Use first() to get a single record

        if(empty($username) || empty($password)) {
            // Redirect back to the profile page with a message
            return redirect()->to('/')->with('status', 'Please fill all the fields');
        }
        // Check if user exists
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $this->session->set('user', $user);

                // Redirect to the admin page
                return redirect()->to('/admin/index');
            } else {
                // Redirect back to the profile page with a message
                return redirect()->to('/')->with('status', 'Incorrect username or password');
            }
        } else {
            // Redirect back to the profile page with a message
            return redirect()->to('/')->with('status', 'Incorrect username or password');
        }
    }

    //logout admin and session
    public function logout()
    {
        session_destroy();
        return redirect()->to(uri: base_url('/'));
    }
}
