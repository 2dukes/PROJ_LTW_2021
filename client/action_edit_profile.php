<?php
session_start();

include_once('../server/connection.php');
include_once('../server/users.php');
$user = getUser($_GET['username']);

if (isset($_SESSION['username'])){
    if($_SESSION['username'] != $user["username"]){
        header('Location: profile.php?username='.$_GET['username'].'&failed=1');
        die();
    }

    editUser(
        $_POST["name"],
        $_POST["username"]
    );
    header('Location: profile.php?username='.$_GET['username']);
}

die();

