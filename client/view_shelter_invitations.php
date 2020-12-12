<?php
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once SERVER_DIR.'/notifications.php';
require_once SERVER_DIR . '/users.php';
require_once SERVER_DIR . '/shelters.php';

$title = "Shelter invitations";

require_once 'templates/common/header.php';
if(isset($_SESSION['username'])) {
    $shelterInvitations = getUserShelterInvitation($_SESSION['username']);
    require_once 'templates/users/view_shelter_invitations.php';
    if(!isset($_GET['failed']) && !isset($_GET['errorCode'])){
        echo '<section class="messages-column-body">';
        drawShelterInvitations($shelterInvitations, false);
        echo '</section>';
    }
    else { // Defensive programming
        drawInvitationError();
        die();
    }
}
require_once 'templates/common/footer.php';
