<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    
//login and registration routes
$routes->get('/','AuthenticationController::login');
$routes->get('register','AuthenticationController::register');

//admin routes
//admin main view | dashboard route
$routes->get('/admin/index','AdminController::index');

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

//delete membership plan from db route
$routes->delete('/admin/delete_membership/(:num)', 'AdminController::deleteMembership/$1');
