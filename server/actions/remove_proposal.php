<?php
session_start();

include_once __DIR__ . '/../server.php';
include_once SERVER_DIR.'/connection.php';
include_once SERVER_DIR.'/pets.php';
include_once SERVER_DIR.'/users.php';

$petId = $_GET['id'];

if (isset($_SESSION['username'])){
    withdrawAdoptionRequest($_SESSION['username'], $petId);
    header("Location: " . CLIENT_URL . "/pet.php?id=$petId");
}

die();