<?php
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
try {
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once SERVER_DIR.'/notifications.php';

require_once('templates/common/header.php');
?> <h3><a href="pets.php">View Pets Listed For Adoption</a></h3> <?php
?> <h3><a href="adopted_pets.php">View Adopted Pets</a></h3> <?php
require_once('templates/common/footer.php');
}
catch (Exception $e) {
    header( "Location: error.php" );die();
}
