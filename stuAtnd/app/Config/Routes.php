<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/save', 'AuthController::save');
$routes->post('/login/auth', 'AuthController::auth');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'AuthController::dashboard', ['filter' => 'auth']);

$routes->get('students', 'Home::students');
$routes->post('add-student', 'Home::addStudent');

$routes->get('attendance-form', 'Home::attendanceForm');
$routes->post('submit-attendance', 'Home::submitAttendance');
$routes->get('attendance-report', 'Home::attendanceReport');
