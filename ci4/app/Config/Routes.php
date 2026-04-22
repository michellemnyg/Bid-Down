<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'Page::index');
$routes->get('login', 'Page::login');
$routes->get('register', 'Page::register');