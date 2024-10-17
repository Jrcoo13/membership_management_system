<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentsModel;
use App\Models\MembershipModel;

class AdminController extends BaseController
{
    public function index()
    {
        $student = new StudentsModel();
        // Get the total number of students
        $data['total_students'] = $student->countAll(); 
        $data['student'] = $student->orderBy('join_date', 'DESC')  // Order by created_at or 'id' DESC
            ->limit(5)                      // Limit to the latest 5 records
            ->findAll();

        return view('admin/index', $data);
    }

    public function students()
    {
        $student = new StudentsModel();
        $data['student'] = $student->findAll();
        return view('/admin/students', $data);
    }

    public function getStudent()
    {
        $student = new StudentsModel();

        $data['student'] = $student->findAll();

        return view('/admin/index', $data);
    }

    //add student ui view
    public function addStudentView()
    {
        return view('/admin/add_student');
    }

    //add student to db
    public function addStudent()
    {
        $student = new StudentsModel();
        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'name' => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
        ];
        $student->save($data);
        return redirect()->to('/admin/students')->with('status', 'Student Added Successfully');
    }

    //edit student ui view
    public function editStudentView($id)
    {
        $student = new StudentsModel();
        $data['student'] = $student->find($id);
        return view('admin/edit_student', $data);
    }

    //update student data
    public function updateStudentData($id)
    {
        $student = new StudentsModel();
        $student->find($id);
        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'name' => $this->request->getPost('full_name'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
        ];
        $student->update($id, $data);
        return redirect()->to('/admin/students')->with('status', 'Student Updated Successfully');
    }
    //manage membership view
    public function membershipPlansView()
    {
        $memberships = new MembershipModel();

        $data['memberships'] = $memberships->findAll();
        return view('/admin/membership_plans', $data);
    }
    //delete student from db
    public function deleteStudent($id)
    {
        $student = new StudentsModel();
        $student->delete($id);
        return redirect()->to(uri: base_url('/admin/students'))->with('status', 'Student deleted successfully');
    }
}
