<?php

use CodeIgniter\Events\Events;
use CodeIgniter\Router\RouteCollection;

function AdminRoutes(RouteCollection $routes, string $dir, string $controller): void
{
    $routes->get('/admin/'.$dir, 'Admin\\'.$controller.'::indexView', ['as' => $dir]);
    $routes->get('/admin/'.$dir.'/create', 'Admin\\'.$controller.'::createView', ['as' => $dir.'-create']);
    $routes->post('/admin/'.$dir.'/create', 'Admin\\'.$controller.'::createAction');
    $routes->get('/admin/'.$dir.'/edit/(:num)', 'Admin\\'.$controller.'::editView/$1', ['as' => $dir.'-edit']);
    $routes->post('/admin/'.$dir.'/edit/(:num)', 'Admin\\'.$controller.'::editAction/$1');
    $routes->get('/admin/'.$dir.'/remove/(:num)', 'Admin\\'.$controller.'::removeAction/$1', ['as' => $dir.'-remove']);
}

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main\Home::index', ['as' => 'main-home']);
$routes->get("/menu", "Main\Menu::index", ['as' => 'menu']);
$routes->get("/sobre-nos", "Main\About::index", ['as' => 'about']);
$routes->get('/contatar', 'Main\Contact::index', ['as' => 'contact']);
$routes->get('/loja', 'Main\Shop::index', ['as' => 'shop']);
$routes->get('/admin', 'Admin\Home::index', ['as' => 'admin-home']);

// Users
$routes->get('/admin/users', 'Admin\Users::index', ['as' => 'users']);
$routes->get('/admin/users/create', 'Admin\Users::createView', ['as' => 'user-create']);
$routes->post('/admin/users/create', 'Admin\Users::createAction');
$routes->get('/admin/users/edit/(:num)', 'Admin\Users::editView/$1', ['as' => 'user-edit']);
$routes->post('/admin/users/edit/(:num)', 'Admin\Users::editAction/$1');
$routes->get('/admin/users/remove/(:num)', 'Admin\Users::removeAction/$1', ['as' => 'user-remove']);

// Products
AdminRoutes($routes, 'products', 'Products');

// Categories
AdminRoutes($routes, 'categories', 'Categories');

service('auth')->routes($routes);
