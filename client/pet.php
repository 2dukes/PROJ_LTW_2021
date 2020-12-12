<?php
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
try {
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once SERVER_DIR.'/notifications.php';
require_once SERVER_DIR.'/pets.php';
require_once SERVER_DIR.'/users.php';
$pet = Pet::fromDatabase($_GET['id']);
$comments = $pet->getComments();

$title = $pet->getName();

?>
<script>
let pet = <?= json_encode($pet) ?>;
let comments = <?= json_encode($comments) ?>;
</script>
<?php

if (isset($_SESSION['username'])) {
    $user = User::fromDatabase($_SESSION['username']);
?>
    <script>
        let user = <?= json_encode($user) ?>;
    </script>
    <script src="js/handleFavorites.js" defer></script>
<?php
}

$javascript_files = ['js/utils_elements.js', 'js/Comment.js', 'js/CommentTree.js', 'js/petPhotos.js', 'js/commentImage.js', 'js/utils_elements.js'];

require_once 'templates/common/header.php';
require_once 'templates/pets/view_pet.php';
require_once 'templates/common/footer.php';
}
catch (Exception $e) {
    header( "Location: error.php" );die();
}
