<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentsModel;

class LSCFormController extends BaseController
{
    public function index()
    {
        return view('/lsc_form/index');
    }

    public function submitForm() {
        $student = new StudentsModel();
        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'student_name' => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
            'degree_program' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'status' => 'Processing'
        ];
        $student->save($data);
        return redirect()->to('lsc_membership_form')->with('status', 'Your membership form has been submitted.');
    }
}
