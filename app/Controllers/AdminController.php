<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendingPaymentModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentsModel;
use App\Models\MembershipModel;
use App\Models\PastTransactionModel;

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
    //delete student from db
    public function deleteStudent($id)
    {
        $student = new StudentsModel();
        $student->delete($id);
        return redirect()->to(uri: base_url('/admin/students'))->with('status', 'Student deleted successfully');
    }
    //manage membership view
    public function membershipPlansView()
    {
        $memberships = new MembershipModel();

        $data['memberships'] = $memberships->findAll();
        return view('/admin/membership_plans', $data);
    }
    //add new membership plans view
    public function addNewMembershipPlan()
    {
        return view('/admin/add_new_membership');
    }

    //add new membership to db
    public function addMembershipPlan()
    {
        $membership = new MembershipModel();
        $data = [
            'membership_name' => $this->request->getPost('membership_name'),
            'partial_payment' => $this->request->getPost('partial_payment'),
            'amount' => $this->request->getPost('amount')
        ];
        $membership->save($data);
        return redirect()->to('/admin/membership_plans')->with('status', 'Membership Fee Added Successfully');
    }
    //edit membership fee view
    public function editMembershipPlan($id)
    {
        $membership = new MembershipModel();
        $data['membership'] = $membership->find($id);
        return view('/admin/edit_membership', $data);
    }
    //update membership data from db
    public function updateMembershipPlan($id)
    {
        $membership = new MembershipModel();
        $membership->find($id);
        $data = [
            'membership_name' => $this->request->getPost('membership_name'),
            'partial_payment' => $this->request->getPost('partial_payment'),
            'amount' => $this->request->getPost('amount')
        ];
        $membership->update($id, $data);
        return redirect()->to('/admin/membership_plans')->with('status', 'Membership Fee Updated Successfully');
    }
     //delete membership plan from db
     public function deleteMembership($id)
     {
         $membership = new MembershipModel();
         $membership->delete($id);
         return redirect()->to(uri: base_url('/admin/membership_plans'))->with('status', 'Membership Fee deleted successfully');
     }
    //delete membership from db
    // public function delete($id)
    // {
    //     $membership = new MembershipModel();
    //     $membership->delete($id);
    //     return redirect()->to(uri: base_url('/admin/membership_plans'))->with('status', 'Membership deleted successfully');
    // }
    // public function delete($id)
    // {
    //     $membership = new MembershipModel();

    //     // Check if the ID is valid
    //     if ($membership->find($id)) {
    //         $membership->delete($id); // Delete the membership
    //         return redirect()->to(base_url('/admin/membership_plans'))->with('status', 'Membership deleted successfully');
    //     } else {
    //         return redirect()->to(base_url('/admin/membership_plans'))->with('status', 'Membership not found');
    //     }
    // }
    //pending payments view 
    public function pendingPaymentView() {
        $pending_payment = new PendingPaymentModel();
        $data['pending_payment'] = $pending_payment->findAll();
        return view('/admin/pending_payment', $data);
    }

    //past transaction view
    public function paymentHistoryView() {
        $past_transaction = new PastTransactionModel();
        $data['past_transaction'] = $past_transaction->findAll();
        return view('/admin/payment_history', $data);
    }
}
