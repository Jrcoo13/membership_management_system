<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MembershipModel;
use App\Models\StudentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class FormController extends BaseController
{
    public function formView()
    {
        $membership = new MembershipModel();
        $data['memberships'] = $membership->findAll();
        return view('form', $data);
    }


    public function submit()
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
                return redirect()->to('/form')->with('success', 'Form has been successfully submitted.');
            } else {
                // log_message('error', 'Failed to send confirmation email to ' . $studentData['email'] . '. Error: ' . implode(', ', $emailService->printDebugger()));
                return redirect()->to('/form')->with('error', 'Form has been sutmitted, but there was an error sending the confirmation email.');
            }
        }

        return redirect()->to('/form')->with('error', 'There was an error submitting the form.');
    }


    private function generateEmailMessage($studentData, $selectedMemberships, $membershipModel)
    {
        $st = 'st';  // Consider removing this or making it dynamic based on the semester
        $currencySymbol = '&#8369;';

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
            <li><strong>Amount Paid:</strong> {$currencySymbol}{$studentData['amount_paid']}</li>
            <li><strong>Reference Number:</strong> {$studentData['reference_id']}</li>
        </ul>

        <p><strong>Your Memberships:</strong></p>
        <ul class='membership-list'>
";

        if ($selectedMemberships) {
            $memberships = $membershipModel->whereIn('id', $selectedMemberships)->findAll();
            foreach ($memberships as $membership) {
                $message .= "<li>{$membership['membership_name']} - {$currencySymbol}{$membership['amount']}</li>";
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
}
