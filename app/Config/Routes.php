<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main\Home::index', ['as' => 'main-home']);
$routes->get("/menu", "Main\Menu::index", ['as' => 'menu']);
$routes->get("/sobre-nos", "Main\About::index", ['as' => 'about']);
$routes->get('/contatar', 'Main\Contact::index', ['as' => 'contact']);
$routes->get('/loja', 'Main\Shop::index', ['as' => 'shop']);
$routes->get('/admin', 'Admin\Home::index', ['as' => 'admin-home']);
$routes->get('/admin/users', 'Admin\Users::index', ['as' => 'users']);
$routes->get('/admin/users/create', 'Admin\Users::createView', ['as' => 'user-create']);
$routes->post('/admin/users/create', 'Admin\Users::createAction');
$routes->get('/admin/users/edit/(:num)', 'Admin\Users::editView/$1', ['as' => 'user-edit']);
$routes->post('/admin/users/edit/(:num)', 'Admin\Users::editAction/$1');
$routes->get('/admin/users/remove/(:num)', 'Admin\Users::removeAction/$1', ['as' => 'user-remove']);

service('auth')->routes($routes);
