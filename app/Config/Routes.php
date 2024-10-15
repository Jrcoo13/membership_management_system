<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    
//login and registration routes
$routes->get('/','AuthenticationController::login');
$routes->get('register','AuthenticationController::register');

//admin routes
$routes->get('/admin/index','AdminController::index');

$routes->get('/admin/students','AdminController::students');
