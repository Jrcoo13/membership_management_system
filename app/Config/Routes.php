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

//membership plans view route
$routes->get('/admin/membership_plans', 'AdminController::membershipPlansView');

//delete student from db route
$routes->delete('/admin/delete_student/(:num)', 'AdminController::deleteStudent/$1');