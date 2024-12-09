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

        // Get today's date
        $today = date('Y-m-d'); // Format: YYYY-MM-DD

        // Count the number of students who paid today
        $data['todays_payments'] = $student
            ->where('status', 'Approved')
            ->where('DATE(transaction_date)', $today) // Filter by today's date
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
        return redirect()->to('/admin/admin_profile')->with('success', 'Successfully updated');
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
        $membership = new MembershipModel();
        $data['memberships'] = $membership->findAll();
        return view('/admin/add_student', $data);
    }

    //add student to db
    public function addStudent()
    {
        $membershipModel = new MembershipModel();
        $studentModel = new StudentsModel();

        // Retrieve POST data
        $selectedMemberships = $this->request->getPost('membership_name') ?: [];
        $studentData = [
            'student_id' => $this->request->getPost('student_id'),
            'student_name' => $this->request->getPost('fullname'),
            'degree_program' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'semester' => $this->request->getPost('semester'),
            'email' => $this->request->getPost('email'),
            'mobile_number' => $this->request->getPost('mobile_number'),
            'amount_paid' => $this->request->getPost('amount_paid'),
            'membership_paid' => $selectedMemberships ? implode(',', $selectedMemberships) : null,
            'status' => 'Approved',
            'reference_id' => $this->generateReferenceId(),
        ];

        // Save the student data
        if ($studentModel->save($studentData)) {
            // Prepare email content
            $subject = 'Cotsu LSC Membership - Registration Confirmation';
            $message = $this->generateEmailMessage($studentData, $selectedMemberships, $membershipModel);

            // Send email
            $emailService = \Config\Services::email();
            $emailService->setTo($studentData['email']);
            $emailService->setFrom('cotsulscmembership@gmail.com', 'Cotsu LSC');
            $emailService->setSubject($subject);
            $emailService->setMessage($message);

            // Check if the email was sent successfully
            if ($emailService->send()) {
                return redirect()->to('/admin/add_student')->with('success', 'Student has been added.');
            } else {
                return redirect()->to('/admin/add_student')->with('success', 'Student has been added.');
            }
        }

        return redirect()->to('/admin/add_student')->with('error', 'There was an error adding the student.');
    }

    private function generateEmailMessage($studentData, $selectedMemberships, $membershipModel)
    {
        $st = 'st';
        $message = "
    <html>
    <head>
        <title>Cotsu LSC Membership - Registration Confirmation</title>
        <style>
            body { font-family: Arial, sans-serif; }
            h3 { color: #0056b3; }
            p { font-size: 16px; line-height: 1.6; }
            ul { font-size: 16px; }
            li { margin: 8px 0; }
            .membership-list { margin-top: 10px; }
            .membership-list li { color: #555555; }
        </style>
    </head>
    <body>
        <h3>Hello {$studentData['student_name']},</h3>
        <p>Thank you for registering with the Cotsu LSC Membership!</p>
        
        <p><strong>Here are the details of your registration:</strong></p>
        <ul>
            <li><strong>Student ID:</strong> {$studentData['student_id']}</li>
            <li><strong>Degree Program:</strong> {$studentData['degree_program']}</li>
            <li><strong>Year Level:</strong> {$studentData['year_level']}</li>
            <li><strong>Section:</strong> {$studentData['section']}</li>
            <li><strong>Semester:</strong> {$studentData['semester']}{$st}</li>
            <li><strong>Amount Paid:</strong> &#8369;{$studentData['amount_paid']}</li>
            <li><strong>Reference Number:</strong> {$studentData['reference_id']}</li>
        </ul>

        <p><strong>Your Memberships:</strong></p>
        <ul class='membership-list'>
";

        if ($selectedMemberships) {
            $memberships = $membershipModel->whereIn('id', $selectedMemberships)->findAll();
            foreach ($memberships as $membership) {
                $message .= "<li>{$membership['membership_name']} - &#8369;{$membership['amount']}</li>";
            }
        }
        $message .= "
</ul>
<p>If you have any questions or need assistance, feel free to contact us at <strong>cotsulscmembership@gmail.com</strong>.</p>
<br>
<p>Best regards,<br>The Cotsu LSC</p>
</body>
</html>";

        return $message;
    }

    function generateReferenceId()
    {
        $referenceId = mt_rand(100000000000, 999999999999);
        return $referenceId;
    }


    public function viewStudent($id)
    {
        // Load the models
        $studentModel = new StudentsModel();
        $membershipModel = new MembershipModel();

        // Fetch student data by ID
        $student = $studentModel->find($id);

        // Fetch all memberships
        $memberships = $membershipModel->findAll();

        // Pass student and membership data to the view
        $data['student'] = $student;
        $data['memberships'] = $memberships;

        // Ensure membership IDs are passed as an array for the selected memberships
        $selectedMembershipIds = explode(',', $student['membership_paid']);
        $data['selectedMembershipIds'] = $selectedMembershipIds;

        return view('/admin/view_student', $data);
    }

    //edit student ui view
    public function editStudentView($id)
    {
        $student = new StudentsModel();
        $data['student'] = $student->find($id);
        return view('/admin/edit_student', $data);
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
            'section' => $this->request->getPost('section'),
            'semester' => $this->request->getPost('semester'),
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

    public function paymentHistoryView()
    {
        // Load the models
        $studentsModel = new StudentsModel();
        $membershipModel = new MembershipModel();

        // Fetch past transactions with 'Approved' or 'Rejected' status
        $pastTransactions = $studentsModel
            ->whereIn('status', ['Approved', 'Rejected'])
            ->findAll();

        // Prepare detailed transaction data
        foreach ($pastTransactions as &$transaction) {
            $membershipPaidIds = explode(',', $transaction['membership_paid']); // Split '43,44' into an array

            // Fetch membership details if IDs exist
            if (!empty($membershipPaidIds)) {
                $transaction['membership_details'] = $membershipModel
                    ->whereIn('id', $membershipPaidIds)
                    ->findAll();
            } else {
                $transaction['membership_details'] = [];
            }
        }

        // Pass the processed transactions to the view
        $data['past_transaction'] = $pastTransactions;

        // Return the view with data
        return view('/admin/payment_history', $data);
    }
}
