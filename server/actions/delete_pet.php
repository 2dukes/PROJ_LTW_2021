<?php

require_once __DIR__ . '/../server.php';
require_once SERVER_DIR.'/connection.php';
require_once SERVER_DIR.'/Pet.php';
$pet = Pet::fromDatabase($_GET['id']);

if (isset($_SESSION['username'])){
    if($_SESSION['username'] != $pet->getPostedById()){
        header("Location: " . PROTOCOL_API_URL . "/pet/{$_GET['id']}&failed=1");
        die();
    }

    deleteAllPetCommentPhotos($_GET['id']);

    Pet::deleteFromDatabase($_GET['id']);
}

header("Location: " . PROTOCOL_API_URL . "/pet");

die();
