<?php
$photos = getPetPhotos($pet['id']);
?>
<article id="pet">
    <form action="<?= SERVER_URL ?>/actions/edit_pet.php?id=<?= $pet['id'] ?>" method="post">
        <header>
            <h1><input type="text" name="name" placeholder="Pet name" value="<?=$pet['name']?>" required></h1>
            <div id="data">
                <span id="location"><input type="text" name="location" placeholder="Location" value="<?=$pet['location']?>" required></span>
            </div>
            <div id="pet-photos">
                <a id="add-photo" onclick="addPetPhoto(this.parentNode)">Add photo</a>
                <div id="pet-photos-inputs">
                    <input id="photo-number" name="photo-number" type="hidden" value="<?= count($photos) ?>">
                    <?php for ($i = 0; $i < count($photos); $i++) { ?>
                        <input id="old-<?= $i ?>" name="old-<?= $i ?>" value="<?= $i ?>" type="hidden"/>
                        <input id="new-<?= $i ?>" name="new-<?= $i ?>" value="" type="file" style="display: none"/>
                    <?php } ?>
                </div>
                <div id=pet-photos-row>
                    <?php for ($i = 0; $i < count($photos); $i++) { ?>
                        <div id="picture-<?= $i ?>">
                            <img id="img-<?= $i ?>" src="<?= $photos[$i] ?>"/>
                            <a onclick="browsePetPhoto(this)">Browse new picture</a>
                            <a onclick="deletePetPhoto(this)">Delete</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </header>
        <section id="description">
            <h2>Description</h2>
            <textarea name="description"><?=$pet['description']?></textarea>
        </section>
        <section id="about">
            <h2>About</h2>
            <div id="age">
                <span class="name">Age</span>
                <span class="value"><input type="number" name="age" step="any" value="<?=$pet['age']?>" required></span>
            </div>
            <div id="sex">
                <span class="name">Sex </span>
                <span class="value">
                    <select name="sex" value="<?=$pet['sex']?>">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </span>
            </div>
            <div id="species">
                <span class="name">Species</span>
                <span class="value"><input type="text" name="species" placeholder="eg., cat, dog, ..." value="<?=$pet['species']?>" required></span>
            </div>
            <div id="size">
                <span class="name">Size </span>
                <span class="value">
                    <select name="size" value="<?=$pet['size']?>">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </span>
            </div>
            <div id="color">
                <span class="name">Color </span>
                <span class="value"><input type="text" name="color" value="<?=$pet['color']?>" required></span>
            </div>
        </section>
        <input type="submit" value="Submit">
    </form>
    <div id="delete-pet">
        <a href="<?= SERVER_URL ?>/actions/delete_pet.php?id=<?= $pet['id'] ?>" onclick="return confirm('Do you want to remove this pet?')">Remove Pet</a>
    </div>
</article>