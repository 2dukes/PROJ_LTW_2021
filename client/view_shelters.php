<?php
session_start();

include_once __DIR__.'/../server/server.php';
include_once SERVER_DIR.'/connection.php';
include_once __DIR__.'/../server/notifications.php';
include_once SERVER_DIR.'/Shelter.php';

$shelters = getAllShelters();
$title = "Shelters";

include_once 'templates/common/header.php';
include_once 'templates/shelters/view_Shelter.php';
include_once 'templates/common/footer.php';