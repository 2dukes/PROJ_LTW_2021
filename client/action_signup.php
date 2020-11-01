<?php
session_start();

include_once('../server/connection.php');
include_once('../server/users.php');

if (strcmp($_POST['pwd'], $_POST['rpt_pwd']) != 0) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => "Password don't match");
    die(header('Location: ../signup.php'));
}


if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
    die(header('Location: ../signup.php'));
}

if(addUser($_POST['username'], $_POST['pwd'], $_POST['name'])){
    header('Location: profile.php?id='.$_POST['username']);
} else {
    header('Location: signup.php?failed=1');
}

die();
