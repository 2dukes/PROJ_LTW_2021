<?php
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once __DIR__.'/../server/notifications.php';

require_once('templates/common/header.php');
?> <h3><a href="pets.php">View Pets Listed For Adoption</a></h3> <?php
?> <h3><a href="adopted_pets.php">View Adopted Pets</a></h3> <?php
require_once('templates/common/footer.php');
