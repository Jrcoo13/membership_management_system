<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthenticationController extends BaseController
{
    public function loginView()
    {
        // Check if user is logged in and session has user data
        $user = session()->get('user');

        // If user is not logged in or does not have a valid ID, redirect to the home page
        if (!$user || $user['id'] < 1) {
            return view('login');
        } else
        return redirect()->to(uri: base_url('/admin/index'));
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
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please fill all the required fields.',
            ]);
        }
        // Check if user exists
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $this->session->set('user', $user);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Success',
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Incorrect username or password.',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Incorrect username or password.',
            ]);
        }
    }

    //logout admin and session
    public function logout()
    {
        session_destroy();
        return redirect()->to(uri: base_url('/'));
    }
}
