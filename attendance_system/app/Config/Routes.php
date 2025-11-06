<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');


// Default routes (keep these)
$routes->get('/index', 'AttendanceController::index');

// Custom routes for Student Attendance System

// Student-related routes
$routes->get('/add-student', 'AttendanceController::addStudent');
$routes->post('/save-student', 'AttendanceController::saveStudent');

// Attendance-related routes
$routes->get('/attendance', 'AttendanceController::attendanceForm');
$routes->post('/save-attendance', 'AttendanceController::saveAttendance');

// Report-related route
$routes->get('/report', 'AttendanceController::report');