<?php
require_once __DIR__.'/../../server.php';
require_once SERVER_DIR . '/rest/authentication.php';
Authentication\CSPHeaderSet();
$CSRFtoken = Authentication\CSRF_GetToken();
require_once SERVER_DIR . '/connection.php';
require_once SERVER_DIR . '/Notification.php';
require_once SERVER_DIR . '/User.php';
require_once SERVER_DIR . '/Shelter.php';
require_once SERVER_DIR . '/errors/errors.php';

$title = "Change password";

$javascript_files = [
    PROTOCOL_CLIENT_URL.'/js/signup.js'
];

require_once CLIENT_DIR.'/templates/common/header.php';
if (isset($_SESSION['username']) && $_SESSION['username'] == $user->getUsername())
    require_once CLIENT_DIR.'/templates/users/change_password.php';

require_once CLIENT_DIR.'/templates/common/footer.php';