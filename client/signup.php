<?php 
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
try {
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/errors/errors.php';

$title = "Sign Up";
$javascript_files = ['js/signup.js'];
require_once 'templates/common/header.php';
require_once 'templates/authentication/signup.php';
require_once SERVER_DIR . '/shelters.php';

require_once 'templates/common/footer.php';
}
catch (Exception $e) {
    header( "Location: error.php" );die();
}
