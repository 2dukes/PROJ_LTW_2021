<section id="profile">
    <header>
        <img class="profile-pic" id="profile_img" src="<?=$user['pictureUrl']?>">
        <span id="name"><?=$user['name']?></span>
        <span id="username"><?=$user['username']?></span>
        <a href="edit_profile.php?username=<?=$_SESSION['username']?>">Edit Profile</a>
    </header>
    <section id="owned">
        <h2>Pets owned</h2>
    <?php
    if(empty($added_pets)) echo '<p>No pets</p>';
    else
    foreach ($added_pets as $pet) {
        $photoUrl = getPetMainPhoto($pet['id']);
        ?>
        <article class="pet">
            <header>
                <h2><a href="pet.php?id=<?= $pet['id']?>"><?= $pet['name'] ?></a></h2>
            </header>
            <img src="<?= $photoUrl ?>" alt="photo of <?= $pet['name'] ?>" />
        </article>
    <?php } ?>
    </section>
    <section id="favorites">
    <h2>Favorites</h2>
    <?php
    if(empty($favorite_pets)) echo '<p>No favorite pets</p>';
    else
    foreach ($favorite_pets as $pet) {
        $photoUrl = getPetMainPhoto($pet['id']);
        ?>
        <article class="pet">
            <header>
                <h2><a href="pet.php?id=<?= $pet['id']?>"><?= $pet['name'] ?></a></h2>
            </header>
            <img src="<?= $photoUrl ?>" alt="photo of <?= $pet['name'] ?>" />
        </article>
    <?php } ?>
    </section>
    <section id="actions">
        <h2>Actions</h2>
        <ul>
            <li><a href="add_pet.php">➕ Add pet</a></li>
        </ul>
    </section>
</section>