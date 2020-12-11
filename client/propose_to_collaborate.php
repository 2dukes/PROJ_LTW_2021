<?php
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once __DIR__.'/../server/notifications.php';
require_once SERVER_DIR.'/shelters.php';

$user = getUser($_GET['username']);
$title = "Collaborate proposal";

if (isset($_SESSION['username']) && isset($_SESSION['isShelter'])) {
    $shelter = getShelter($_SESSION['username']);
}

require_once 'templates/common/header.php';
require_once 'templates/shelters/propose_to_collaborate.php';
require_once 'templates/common/footer.php';