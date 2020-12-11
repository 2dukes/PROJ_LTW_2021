<?php
session_start();

require_once __DIR__ . '/../server.php';
require_once SERVER_DIR.'/connection.php';
require_once SERVER_DIR.'/notifications.php';
require_once SERVER_DIR.'/pets.php';
require_once SERVER_DIR.'/users.php';

$petId = $_GET['id'];

if (isset($_SESSION['username'])){
    addAdoptionRequest($_SESSION['username'], $petId, $_POST['description']);

    $pet = getPet($petId);
    $petOwner = $pet['postedBy'];

    addNotification($petOwner, "newPetAdoptionProposal", "You have a new adoption proposal for ". $pet['name'] . ", by " . $_SESSION['username'] . ".");

    header("Location: " . PROTOCOL_CLIENT_URL . "/pet.php?id=$petId");
}

die();