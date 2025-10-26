<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Attendance routes
$routes->get('attendance', 'Attendance::index');
$routes->get('attendance/addStudent', 'Attendance::addStudent');
$routes->post('attendance/saveStudent', 'Attendance::saveStudent');
$routes->get('attendance/mark', 'Attendance::mark');
$routes->post('attendance/saveAttendance', 'Attendance::saveAttendance');
$routes->get('attendance/report', 'Attendance::report');
