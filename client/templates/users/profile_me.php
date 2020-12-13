<section id="profile">
    <header>
        <img class="profile-pic" id="profile_img" src="<?php echo (is_null($user->getPictureUrl()) ? "resources/img/no-image.svg": $user->getPictureUrl()) ?>">
        <span id="name"><?=$user->getName()?></span>
        <span id="username"><?=$user->getUsername()?></span>
        <a href="edit_profile.php?username=<?=$_SESSION['username']?>">Edit Profile</a>
    </header>
    <?php
    require_once CLIENT_DIR.'/templates/pets/view_pets_in_profile.php';
    ?>
    <section id="actions">
        <h2>Actions</h2>
        <ul>
            <li><button onclick="location.href = 'add_pet.php'">Add pet</button></li>
            <li><button onclick="location.href = 'view_proposals.php'">Proposals to my pets</button></li>
            <li><button onclick="location.href = 'my_proposals.php'">My proposals</button></li>
            <li><button onclick="location.href = 'view_adopted_pets_by_user.php'">View adopted pets</button></li>
            <li><button onclick="location.href = 'view_previously_owned_pets.php'">View previously owned pets</button></li>
            <?php 
                if(checkUserBelongsToShelter($user->getUsername())) { 
                    $shelterName = User::fromDatabase($user->getUsername())->getShelterId(); ?>
                    <li><button onclick="location.href = '<?= PROTOCOL_CLIENT_URL ?>/profile.php?username=<?=$shelterName?>'">View shelter</button></li>
            <?php } else { ?>
                    <li><button onclick="location.href = 'view_shelter_invitations.php'">View shelter invitations</button></li>
            <?php } ?>
        </ul>
    </section>
</section>