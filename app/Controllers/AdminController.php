<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendingPaymentModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentsModel;
use App\Models\MembershipModel;
use App\Models\PastTransactionModel;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    public function index()
    {
        // Check if user is logged in and session has user data
        $user = session()->get('user');

        // If user is not logged in or does not have a valid ID, redirect to the home page
        if (!$user || $user['id'] < 1) {
            return redirect()->to(uri: base_url('/'));
        } else
            // Create an instance of the StudentsModel
            $student = new StudentsModel();
        // Get the total number of students
        $data['total_students'] = $student->countAll();

        // Get the latest 5 students, ordered by join date
        $data['student'] = $student->orderBy('join_date', 'DESC')  // Order by created_at or 'id' DESC
            ->limit(5)                      // Limit to the latest 5 records
            ->findAll();

        // Create an instance of the PastTransactionModel
        $pastTransaction = new PastTransactionModel();
        // Get the total revenue for the current month
        $monthlyRevenue = $pastTransaction->getMonthlyRevenue();
        // Add the monthly revenue to the data array
        $data['monthly_revenue'] = $monthlyRevenue['amount_paid'] ?? 0;  // Default to 0 if no data

        // Return the view with the data
        return view('/admin/index', $data);
    }

    //admin profile page view
    public function adminProfileView()
    {
        return view('/admin/admin_profile');
    }

    public function updateAdminData($id)
    {
        $admin = new AdminModel();

        // Fetch the existing admin details before the update
        // $existingAdmin = $admin->find($id);

        // Prepare the data for update
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'birth_date' => $this->request->getPost('birth_date'),
            'sex' => $this->request->getPost('sex'),  
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'address' => $this->request->getPost('address'),
        ];

        // Update the admin data in the database
        $admin->update($id, $data);

        // Fetch the updated admin details
        $updatedAdmin = $admin->find($id);

        // Update session data with the new values
        session()->set('user', $updatedAdmin);

        // Redirect back to the profile page with a success message
        return redirect()->to('/admin/admin_profile')->with('status', 'Successfully updated');
    }

    //list of student page view
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

    //past transaction view
    public function paymentHistoryView()
    {
        $past_transaction = new PastTransactionModel();
        $data['past_transaction'] = $past_transaction
        ->whereIn('status', ['Approved','Rejected'])
        ->findAll();
        return view('/admin/payment_history', $data);
    }

    //pending payments view
    public function pendingPaymentView()
    {
        $past_transaction = new PastTransactionModel();
        $data['pending_payment'] = $past_transaction
        ->where('status', 'Processing') //get data that has a processing data on the status field
        //->where('amount_paid', '0') //it also checks if the user is already paid
        ->findAll();
        return view('/admin/pending_payment', $data);
    }
}
