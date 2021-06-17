<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// match(['get', 'post']

// Route untuk method pada Controller Login
$routes->add('/', 'Login::index', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('register', 'Login::register', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('activation', 'Login::activation', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('verify', 'Login::verify', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('forgotPassword', 'Login::forgotPassword', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('reset', 'Login::reset', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('resetPassword', 'Login::resetPassword', ['filter' => 'noauth']); //NoAuth karena user belum login !
$routes->add('changePassword', 'Login::changePassword', ['filter' => 'noauth']); //NoAuth karena user belum login !

// Route untuk method pada Controller Users
$routes->add('home', 'Users::index', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('fotoPertama', 'Users::fotoPertama', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('friend', 'Users::friend', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('friendRequest', 'Users::friendRequest', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('profile', 'Users::profile', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('friendList/(:any)', 'Users::friendList/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('gantiFoto', 'Users::gantiFoto', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('createStatus', 'Users::createStatus', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('likeStatus/(:num)', 'Users::likeStatus/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteStatus/(:num)', 'Users::deleteStatus/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('comment/(:any)', 'Users::comment/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('createComment/(:num)', 'Users::createComment/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('likeComment/(:num)/(:num)', 'Users::likeComment/$1/$2', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteComment/(:num)', 'Users::deleteComment/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('createReply/(:num)/(:num)', 'Users::createReply/$1/$2', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('likeReply/(:num)/(:num)/(:num)', 'Users::likeReply/$1/$2/$3', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteReply/(:num)', 'Users::deleteReply/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('friendPage/(:any)', 'Users::friendPage/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('addFriend/(:num)', 'Users::addFriend/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('acceptFriend/(:num)', 'Users::acceptFriend/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteFriend/(:num)', 'Users::deleteFriend/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteAccountPage', 'Users::deleteAccountPage', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('deleteAccount/(:num)', 'Users::deleteAccount/$1', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('logout', 'Users::logout'); //Logout !

// Route untuk method pada Controller Notification
$routes->add('notifications', 'Notification::index', ['filter' => 'auth']); //Auth karena user sudah login !
$routes->add('toNotification/(:num)', 'Notification::toNotification/$1', ['filter' => 'auth']); //Auth karena user sudah login !

// Route untuk method pada Controller About
$routes->add('abouts', 'About::index', ['filter' => 'auth']); //Auth karena user sudah login !

// Route untuk method pada Controller Admin
$routes->add('admins', 'Admin::index', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('edit/(:any)', 'Admin::edit/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('deleteAccountAdmin/(:num)', 'Admin::deleteAccountAdmin/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('changeLevelUp/(:num)', 'Admin::changeLevelUp/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('changeLevelDown/(:num)', 'Admin::changeLevelDown/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !

// Route untuk method pada Controller Chat
$routes->add('chatList', 'Chat::index', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('chatPage/(:any)', 'Chat::chatPage/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !
$routes->add('chatPageAll/(:any)', 'Chat::chatPageAll/$1', ['filter' => 'auth']); //Admin karena ini adalah halaman khusus admin !


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
