<?php
/**
 * this is where we initiate our global variables and our autuoload register
 */

session_start();

// global variables to be used such as session names mysql connections
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'survey'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

// register our autoload functions
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});
