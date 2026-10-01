<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\Home::notFound');
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->add('registrasi', 'Home::registrasi');

$routes->add('register', '\App\Controllers\Auth::register', ['as' => 'register']);

$routes->add('activate', '\App\Controllers\Auth::activate');
$routes->add('activate/(:alphanum)', '\App\Controllers\Auth::activate/$1');
$routes->add('activate(:any)', '\App\Controllers\Auth::activate/$1', ['as' => 'activate']);

$routes->add('activation-request', '\App\Controllers\Auth::requestActivation', ['as' => 'activation-request']);
$routes->add('reset-password', '\App\Controllers\Auth::requestReset', ['as' => 'reset-password']);

$routes->add('reset', '\App\Controllers\Auth::resetPassword');
$routes->add('reset/(:alphanum)', '\App\Controllers\Auth::resetPassword/$1');
$routes->add('reset(:any)', '\App\Controllers\Auth::resetPassword/$1', ['as' => 'reset']);

$routes->add('login', '\App\Controllers\Auth::login', ['as' => 'login']);
$routes->add('logout', '\App\Controllers\Auth::logout', ['as' => 'logout']);

$routes->group('forbidden', function ($routes)
{
	$routes->add('role', '\App\Controllers\Auth::forbidden/role', ['as' => 'forbidden-role']);
	$routes->add('group', '\App\Controllers\Auth::forbidden/group', ['as' => 'forbidden-group']);
});

$routes->add('test/files/(:any)', '\App\Controllers\Test::files/$1');

$routes->add('login-as', '\App\Controllers\Auth::signmeAs', ['as' => 'login-as']);