<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Posts;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('posts');
