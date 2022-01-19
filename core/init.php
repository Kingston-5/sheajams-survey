<?php

/**
 * this is where we initiate our global variables and our autuoload register
 */

session_start();

// global variables to be used such as session names mysql connections
$GLOBALS['config'] = array(
    'mysql' => array(
        //====================================================
        //test/home server
        //====================================================
        // 'host' => 'localhost',
        // 'username' => 'root',
        // 'password' => '',
        // 'db' => 'survey'
        //====================================================
        //production server
        //====================================================
        'host' => 'localhost:3306',
        'username' => 'main_user',
        'password' => 'v~517TjmxCxqsVig',
        'db' => 'sheajams_main_db'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token',
        'question' => '0',
    )
);

// register our autoload functions
spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});
