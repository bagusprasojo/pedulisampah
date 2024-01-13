<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'AboutController::index');

$routes->get('/trash-reports', 'TrashReports::index');
$routes->get('/trash-reports-pagination', 'TrashReportPagination::index');


$routes->match(['get', 'post'], '/tambah-laporan', 'TrashReports::tambahLaporan');

$routes->match(['get', 'post'], '/register', 'AuthController::register');
$routes->match(['get', 'post'], '/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->match(['get', 'post'],'/comment/add/(:segment)', 'CommentController::addComment/$1');

$routes->get('/full-trash-report/(:segment)', 'TrashReports::fullTrashReport/$1');
$routes->get('trash-comment/(:num)', 'CommentController::index/$1');

$routes->get('/user_dashboard', 'DashboardController::index');
$routes->get('/public_profile/(:segment)', 'DashboardController::public_profile/$1');

$routes->get('/follow/(:num)', 'FollowController::follow/$1');
$routes->get('/unfollow/(:num)', 'FollowController::unfollow/$1');








