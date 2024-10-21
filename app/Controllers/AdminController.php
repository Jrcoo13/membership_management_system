<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendingPaymentModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentsModel;
use App\Models\MembershipModel;
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

        // Get the total number of students with a status of 'Approved'
        $data['total_students'] = $student
            ->where('status', 'Approved')
            ->countAllResults();

        // Get the latest 5 students, ordered by join date
        $data['student'] = $student->orderBy('transaction_date', 'DESC')
            ->where('status', 'Approved') //only return the data that has a 'Approved' status value
            ->limit(5)  //limit the data to be return                    
            ->findAll();

        // Create an instance of the PastTransactionModel
        $pastTransaction = new StudentsModel();
        // Get the total revenue for the current month
        $monthlyRevenue = $pastTransaction->getMonthlyRevenue();
        // Add the monthly revenue to the data array
        $data['monthly_revenue'] = $monthlyRevenue['amount_paid'] ?? 0;  // Default to 0 if no data

        // Return the view with the data
        return view('/admin/index', $data);
    }

    //update admin password
    public function updateAdminPassword($id)
    {
        $admin = new AdminModel();

        $currentPassword = $this->request->getPost('password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        //checks if the password was match to the current password
        if (password_verify($currentPassword, session()->get('user')['password'])) {

            //checks if the new and confirm password is match
            if ($newPassword === $confirmPassword) {
                $data = [
                    'password' => password_hash($newPassword, PASSWORD_DEFAULT),
                ];
                //update the admin password
                $admin->update($id, $data);
                // Updated password was successful
                return redirect()->to('/admin/admin_profile')->with('success', 'Password was successfully updated');
            } else {
                // Update password failed
                return redirect()->to('/admin/admin_profile')->with('error', 'Password did not matched! Please try again.');
            }
        } else {
            // Update password failed
            return redirect()->to('/admin/admin_profile')->with('error', 'Incorrect Password');
        }
    }

    //admin profile page view
    public function adminProfileView()
    {
        return view('/admin/admin_profile');
    }

    public function updateAdminData($id)
    {
        $admin = new AdminModel();

        // Fetch current admin data to preserve the current profile picture if no new one is uploaded
        $currentAdmin = $admin->find($id);

        $img = $this->request->getFile('profile_picture');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // If a valid image is uploaded, generate a random name and move the file
            $validImg = $img->getRandomName();
            $img->move('upload/', $validImg);
        } else {
            // If no new image is uploaded, keep the existing profile picture
            $validImg = $currentAdmin['profile_picture'];
        }

        // Prepare the data for update
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'birth_date' => $this->request->getPost('birth_date'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'address' => $this->request->getPost('address'),
            'profile_picture' => $validImg
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
        $data['student'] = $student
            ->where('status', 'Approved')
            ->findAll();
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
            'student_name' => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
            'degree_program' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'status' => 'Processing'
        ];
        $student->save($data);
        return redirect()->to('/admin/students')->with('status', 'Student has been added.');
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
            'student_name' => $this->request->getPost('full_name'),
            'degree_program' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
        ];
        $student->update($id, $data);
        return redirect()->to('/admin/students')->with('status', 'Student has been updated.');
    }
    //delete student from db
    public function deleteStudent($id)
    {

        $student = new StudentsModel();

        // Attempt to delete the membership
        if ($student->delete($id)) {
            // Deletion was successful
            return $this->response->setJSON(['success' => true]);
        } else {
            // Deletion failed
            return $this->response->setJSON(['success' => false]);
        }
        // $student = new StudentsModel();
        // $student->delete($id);
        // return redirect()->to(uri: base_url('/admin/students'))->with('status', 'Student deleted successfully');
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
    // Delete membership plan from db
    public function deleteMembership($id)
    {
        $membership = new MembershipModel();

        // Attempt to delete the membership
        if ($membership->delete($id)) {
            // Deletion was successful
            return $this->response->setJSON(['success' => true]);
        } else {
            // Deletion failed
            return $this->response->setJSON(['success' => false]);
        }
    }



    //past transaction view
    public function paymentHistoryView()
    {
        $past_transaction = new StudentsModel();
        $data['past_transaction'] = $past_transaction
            ->whereIn('status', ['Approved', 'Rejected'])
            ->findAll();
        return view('/admin/payment_history', $data);
    }

    //pending payments view
    public function pendingPaymentView()
    {
        $past_transaction = new StudentsModel();
        $data['pending_payment'] = $past_transaction
            ->where('status', 'Processing') //get data that has a processing data on the status field
            //->where('amount_paid', '0') //it also checks if the user is already paid
            ->findAll();
        return view('/admin/pending_payment', $data);
    }

    //approved membership payment
    public function approveMembershipRequest($id)
    {
        $user_status = new StudentsModel();
        //change the status to 'Approved'
        $data = [
            'status' => 'Approved',
        ];
        //update the user status
        $user_status->update($id, $data);

        return redirect()->to(uri: base_url('/admin/pending_payment'))->with('status', 'Student has been approved.');
    }

    //reject membership payment
    public function rejectMembershipRequest($id)
    {
        $user_status = new StudentsModel();
        //change the status to 'Approved'
        $data = [
            'status' => 'Rejected',
        ];
        //update the user status
        $user_status->update($id, $data);

        return redirect()->to(uri: base_url('/admin/pending_payment'))->with('status', 'Student has been rejected.');
    }
}
