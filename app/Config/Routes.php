<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    
// SIGN IN AND SIGN OUT ROUTES
$routes->get('/','AuthenticationController::loginView');
$routes->post('/login','AuthenticationController::login');
$routes->get('logout', 'AuthenticationController::logout');


// ADMIN ROUTES
$routes->get('/admin/index','AdminController::index');
$routes->post('/admin/update_password/(:num)', 'AdminController::updateAdminPassword/$1');
$routes->get('/admin/admin_profile', 'AdminController::adminProfileView');
$routes->post('update_admin_data/(:num)', 'AdminController::updateAdminData/$1');

// MANAGE STUDENT ROUTES
$routes->get('/admin/students','AdminController::students');
$routes->get('/admin/add_student', 'AdminController::addStudentView');
$routes->post('/add_student_db', 'AdminController::addStudent');
$routes->get('/admin/view_student/(:num)','AdminController::viewStudent/$1');
$routes->get('/admin/edit_student/(:num)', 'AdminController::editStudentView/$1');
$routes->post('/admin/update_user/(:num)', 'AdminController::updateStudentData/$1');
$routes->delete('/admin/delete_student/(:num)', 'AdminController::deleteStudent/$1');

// MEMBERSHIP ROUTES
$routes->get('/admin/membership_plans', 'AdminController::membershipPlansView');
$routes->get('/admin/add_new_membership', 'AdminController::addNewMembershipPlan');
$routes->post('/admin/add_membership', 'AdminController::addMembershipPlan');
$routes->get('/admin/edit_membership/(:num)', 'AdminController::editMembershipPlan/$1');
$routes->post('/admin/update_membership/(:num)', 'AdminController::updateMembershipPlan/$1');
$routes->delete('/admin/delete_membership/(:num)', 'AdminController::deleteMembership/$1');

// PAYMENT HISTORY ROUTES
$routes->get('/admin/payment_history', 'AdminController::paymentHistoryView');

// FORM ROUTES
$routes->get('/form', 'FormController::formView');
$routes->post('/submit', 'FormController::submit');
