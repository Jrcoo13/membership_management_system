<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    public function index() {
        $student = new AdminModel();
        $data['student'] = $student->findAll();
        return view('admin/index', $data);
    }

    public function students() {
        $student = new AdminModel();
        $data['student'] = $student->findAll();
        return view('/admin/students', $data);
    }

    public function getStudent() {
        $student = new AdminModel();

        $data['student'] = $student->findAll();

        return view('/admin/index', $data);
    }
}
