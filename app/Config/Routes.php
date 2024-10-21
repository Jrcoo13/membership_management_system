<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    
//login and registration routes
$routes->get('/','AuthenticationController::loginView');
$routes->post('/login','AuthenticationController::login');

//logout 
$routes->get('logout', 'AuthenticationController::logout');


//----- ADMIN ROUTES -----
//admin main view | dashboard route
$routes->get('/admin/index','AdminController::index');

//admin update password route
$routes->post('/admin/update_password/(:num)', 'AdminController::updateAdminPassword/$1');

//admin profile page view route
$routes->get('/admin/admin_profile', 'AdminController::adminProfileView');

//admin edit personal information route
$routes->post('update_admin_data/(:num)', 'AdminController::updateAdminData/$1');

//manage student view route
$routes->get('/admin/students','AdminController::students');

//add student view route
$routes->get('/admin/add_student', 'AdminController::addStudentView');

//add student to db
$routes->post('/add_student_db', 'AdminController::addStudent');

//edit student view route
$routes->get('/admin/edit_student/(:num)', 'AdminController::editStudentView/$1');

//update user data routes
$routes->post('/admin/update_user/(:num)', 'AdminController::updateStudentData/$1');

//delete student from db route
$routes->delete('/admin/delete_student/(:num)', 'AdminController::deleteStudent/$1');

//membership plans view route
$routes->get('/admin/membership_plans', 'AdminController::membershipPlansView');

//add new membership plans route
$routes->get('/admin/add_new_membership', 'AdminController::addNewMembershipPlan');

//add membership to db route
$routes->post('/admin/add_membership', 'AdminController::addMembershipPlan');

//edit membership plan route
$routes->get('/admin/edit_membership/(:num)', 'AdminController::editMembershipPlan/$1');

//update membership 
$routes->post('/admin/update_membership/(:num)', 'AdminController::updateMembershipPlan/$1');

// delete membership plan from db route
$routes->delete('/admin/delete_membership/(:num)', 'AdminController::deleteMembership/$1');

//payment history view page route
$routes->get('/admin/payment_history', 'AdminController::paymentHistoryView');

//pending payment view route
$routes->get('admin/pending_payment', 'AdminController::pendingPaymentView');

//approved post  | for updating the user status 
$routes->post('approve_request/(:num)', 'AdminController::approveMembershipRequest/$1');

//rejected post  | for updating the user status 
$routes->post('reject_request/(:num)', 'AdminController::rejectMembershipRequest/$1');

//----- LSC Membership Form ROUTES -----
$routes->get('/lsc_membership_form', 'LSCFormController::index');

//submit membership form
$routes->post('/submit_form', 'LSCFormController::submitForm');

