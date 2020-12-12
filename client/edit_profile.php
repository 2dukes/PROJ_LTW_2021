<?php
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
try {
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR . '/connection.php';
require_once SERVER_DIR.'/notifications.php';
require_once SERVER_DIR . '/users.php';
require_once SERVER_DIR . '/shelters.php';

$title = "Edit profile";

require_once('templates/common/header.php');

if ($_SESSION['username'] === $_GET['username']) {
    $user = User::fromDatabase($_GET['username']);
    require_once('templates/users/edit_profile.php');
    editProfile($user);
}

require_once('templates/common/footer.php');
}
catch (Exception $e) {
    header( "Location: error.php" );die();
}
