<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('user');
$routes->resource('serviceprovider');
$routes->resource('service');
$routes->resource('appointment');
$routes->resource('transaction');
$routes->get('appointmentcostumer/(:num)','UserController::showAppointments/$1');
$routes->get('transactioncostumer/(:num)','UserController::showTransactions/$1');

$routes->get('appointmentprovider/(:num)','ProviderController::showAppointments/$1');
$routes->get('transactionprovider/(:num)','ProviderController::showTransactions/$1');


// service('auth')->routes($routes);

