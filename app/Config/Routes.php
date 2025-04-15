<?php

use CodeIgniter\Events\Events;
use CodeIgniter\Router\RouteCollection;

function AdminRoutes(
    RouteCollection $route_collection,
    string $dir,
    string $controller,
    string ...$routes): void
{
    if (!$routes) $routes = ['indexView', 'createView', 'createAction', 'editView', 'editAction', 'removeAction'];
    if (in_array('indexView', $routes))
        $route_collection->get('/admin/'.$dir, 'Admin\\'.$controller.'::indexView', ['as' => $dir]);
    if (in_array('createView', $routes))
        $route_collection->get('/admin/'.$dir.'/create', 'Admin\\'.$controller.'::createView', ['as' => $dir.'-create']);
    if (in_array('createAction', $routes))
        $route_collection->post('/admin/'.$dir.'/create', 'Admin\\'.$controller.'::createAction');
    if (in_array('editView', $routes))
        $route_collection->get('/admin/'.$dir.'/edit/(:num)', 'Admin\\'.$controller.'::editView/$1', ['as' => $dir.'-edit']);
    if (in_array('editAction', $routes))
        $route_collection->post('/admin/'.$dir.'/edit/(:num)', 'Admin\\'.$controller.'::editAction/$1');
    if (in_array('removeAction', $routes))
        $route_collection->get('/admin/'.$dir.'/remove/(:num)', 'Admin\\'.$controller.'::removeAction/$1', ['as' => $dir.'-remove']);
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

// Books
AdminRoutes($routes, 'books', 'Books', 'indexView', 'removeAction');

// Delivery
$routes->get('/admin/delivery', 'Admin\\Delivery::indexView', ['as' => 'delivery']);
$routes->get('/admin/delivery/edit/(:num)/(:any)', 'Admin\\Delivery::editView/$1/$2', ['as' => 'delivery-edit']);
$routes->post('/admin/delivery/edit/(:num)/(:any)', 'Admin\\Delivery::editAction/$1/$2');
$routes->get('/admin/delivery-item/(:num)/set-quantity/(:num)', 'Admin\\Delivery::editItemQuantityAction/$1/$2');
$routes->get('/admin/delivery/remove/(:num)/(:any)', 'Admin\\Delivery::removeAction/$1/$2', ['as' => 'delivery-remove']);
$routes->get('/admin/delivery-item/(:num)/remove/', 'Admin\\Delivery::removeItemAction/$1', ['as' => 'delivery-item-remove']);

// Auth
service('auth')->routes($routes);
$routes->get('/dashboard', 'Dashboard::indexView', ['as' => 'dashboard']);
$routes->post('/dashboard', 'Dashboard::indexAction');
