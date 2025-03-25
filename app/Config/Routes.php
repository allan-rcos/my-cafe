<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main\Home::index', ['as' => 'home']);
$routes->get("/menu", "Main\Menu::index", ['as' => 'menu']);
$routes->get("/sobre-nos", "Main\About::index", ['as' => 'about']);
$routes->get('/contatar', 'Main\Contact::index', ['as' => 'contact']);
$routes->get('/loja', 'Main\Shop::index', ['as' => 'shop']);
$routes->get('/admin', 'Admin\Home::index', ['as' => 'admin-home']);

service('auth')->routes($routes);
