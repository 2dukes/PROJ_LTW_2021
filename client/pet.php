<?php
session_start();

require_once __DIR__.'/../server/server.php';
require_once SERVER_DIR.'/connection.php';
require_once __DIR__.'/../server/notifications.php';
require_once SERVER_DIR.'/pets.php';
require_once SERVER_DIR.'/users.php';
$pet = getPet($_GET['id']);
$comments = getPetComments($_GET['id']);
$title = $pet['name'];

?>
<script>
let pet = <?= json_encode($pet) ?>;
let comments = <?= json_encode($comments) ?>;
</script>
<?php

if (isset($_SESSION['username'])) {
    $user = getUser($_SESSION['username']);
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
