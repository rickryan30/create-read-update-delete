<?php
defined('ROOT') || define('ROOT',realpath(dirname(__FILE__)));
const DS = DIRECTORY_SEPARATOR;
include_once ROOT.DS.'config'.DS.'config.php';
include_once ROOT.DS.'config'.DS.'dbconfig.php';
include_once ROOT.DS.'helpers'.DS.'core_helper.php'; 
include_once ROOT.DS.'library'.DS.'ti.php';
include_once ROOT.DS.'library'.DS.'unit_test.php';
include_once ROOT.DS.'library'.DS.'vendor'.DS.'autoload.php';

/*global variables*/
define('base_url', $base_url);
/*end global variables*/

header('Access-Control-Allow-Origin: *');
$router = new \Bramus\Router\Router(); 
/*
 * Note To Dev: please read the routing documentation here https://github.com/bramus/router
*/
$request = trim($_SERVER['REQUEST_URI'], "/");
$url = explode('/', $request);
$segment_0 = (isset($url[0])) ? $url[0] : '';
$segment_1 = (isset($url[1])) ? $url[1] : '';
$segment_2 = (isset($url[2])) ? $url[2] : '';
$segment_3 = (isset($url[3])) ? $url[3] : '';
$segment_4 = (isset($url[4])) ? $url[4] : '';

$requested_url = '';
if(isset($url[1])){
    if(strstr($segment_1, '?', true)){
        $requested_url .= '/'.strstr($segment_1, '?', true);
    }else{
        $requested_url .= '/'.$segment_1;
    }
}

if(isset($url[2])){
    if(strstr($segment_2, '?', true)){
        $requested_url .= '/'.strstr($segment_2, '?', true);
    }else{
        $requested_url .= '/'.$segment_2;
    }
}

if(isset($url[3])){
    if(strstr($segment_3, '?', true)){
        $requested_url .= '/'.strstr($segment_3, '?', true);
    }else{
        $requested_url .= '/'.$segment_3;
    }
}

if(isset($url[4])){
    if(strstr($segment_4, '?', true)){
        $requested_url .= '/'.strstr($segment_4, '?', true);
    }else{
        $requested_url .= '/'.$segment_4;
    }
}


/* --- controller route --- */
$router->match('GET|POST', '/controller/register([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'add_user_controller.php';
});

$router->match('GET|POST', '/controller/login([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'select_user_controller.php';
});

$router->match('GET|POST', '/controller/update([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'update_user_controller.php';
});

$router->match('GET|POST', '/controller/change-password([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'change_password_controller.php';
});

$router->match('GET|POST', '/controller/user-listing([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'update_user_listing_controller.php';
});

$router->match('GET|POST', '/controller/user-delete([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'delete_user_controller.php';
});

$router->match('GET|POST', '/controller/add-user([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'add_user_listing_controller.php';
});

$router->match('GET|POST', '/controller/account-delete([a-z0-9_-]+)?', function() {
    require ROOT.DS.'controllers'.DS.'delete_user_account_controller.php';
});
 

/* --- views route --- */
$router->get('', function() {
    require ROOT.DS.'views'.DS.'index.php';
});

$router->get('/', function() {
    require ROOT.DS.'views'.DS.'index.php';
});

$router->get('/home', function() {
    require ROOT.DS.'views'.DS.'index.php';
});

$router->get('/register', function() {
    require ROOT.DS.'views'.DS.'register.php';
});

$router->get('/login', function() {
    require ROOT.DS.'views'.DS.'login.php';
});

$router->get('/update', function() {
    require ROOT.DS.'views'.DS.'update.php';
});

$router->get('/change-password', function() {
    require ROOT.DS.'views'.DS.'change-password.php';
});

$router->get('/admin', function() {
    require ROOT.DS.'views'.DS.'admin.php';
});

$router->get('/logout', function() {
    require ROOT.DS.'views'.DS.'logout.php';
});

$router->run();

