<?php

/**
 * Get array of all pets.
 *
 * @return array    Array of all pets
 */
function getPets() : array {
    global $db;
    $stmt = $db->prepare('SELECT *
    FROM Pet');
    $stmt->execute();
    $pets = $stmt->fetchAll();
    return $pets;
}

/**
 * Get a user's favorite pets.
 *
 * @param string $username  User's username
 * @return array            Array of favorite pets of the user 
 */
function getFavoritePets(string $username) : array {
    global $db;
    $stmt = $db->prepare('SELECT
    Pet.id,
    Pet.name,
    Pet.species,
    Pet.age,
    Pet.sex,
    Pet.size,
    Pet.color,
    Pet.location,
    Pet.description,
    Pet.status,
    Pet.postedBy
    FROM Pet INNER JOIN FavoritePet ON Pet.id=FavoritePet.petId
    WHERE FavoritePet.username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $pet = $stmt->fetch();
    return $pet;
}

/**
 * Add new pet to database.
 *
 * @param string $name          Pet name
 * @param string $species       Species
 * @param float $age            Age (in years; 0.5 for 6 months, for instance)
 * @param string $sex           'M' or 'F'
 * @param string $size          XS, S, M, L, XL
 * @param string $color         Color (as a string)
 * @param string $location      Location
 * @param string $description   Description
 * @param string $postedBy      User that posted the pet
 * @return integer              ID of the new pet
 */
function addPet(
    string $name,
    string $species,
    float  $age,
    string $sex,
    string $size,
    string $color,
    string $location,
    string $description,
    string $postedBy
) : int {
    global $db;
    $stmt = $db->prepare('INSERT INTO Pet
    (name, species, age, sex, size, color, location, description, postedBy)
    VALUES
    (:name, :species, :age, :sex, :size, :color, :location, :description, :postedBy)');
    $stmt->bindParam(':name'       , $name       );
    $stmt->bindParam(':species'    , $species    );
    $stmt->bindParam(':age'        , $age        );
    $stmt->bindParam(':sex'        , $sex        );
    $stmt->bindParam(':size'       , $size       );
    $stmt->bindParam(':color'      , $color      );
    $stmt->bindParam(':location'   , $location   );
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':postedBy'   , $postedBy   );
    $stmt->execute();
    return $db->lastInsertId();
}

/**
 * Get pet information.
 *
 * @param integer $id   ID of pet
 * @return array        Array of named indexes containing pet information
 */
function getPet(int $id) : array {
    global $db;
    $stmt = $db->prepare('SELECT *
    FROM Pet
    WHERE id=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $pet = $stmt->fetch();
    return $pet;
}

/**
 * Edit pet.
 *
 * @param integer $id           Pet ID
 * @param string $name          Pet name
 * @param string $species       Species
 * @param float $age            Age
 * @param string $sex           M/F
 * @param string $size          XS, S, M, L, XL
 * @param string $color         Color
 * @param string $location      Location
 * @param string $description   Description
 * @return void
 */
function editPet(
    int $id,
    string $name,
    string $species,
    float  $age,
    string $sex,
    string $size,
    string $color,
    string $location,
    string $description
){
    global $db;
    $stmt = $db->prepare('UPDATE Pet SET
    name=:name,
    species=:species,
    age=:age,
    sex=:sex,
    size=:size,
    color=:color,
    location=:location,
    description=:description
    WHERE id=:id');
    $stmt->bindParam(':id'         , $id         );
    $stmt->bindParam(':name'       , $name       );
    $stmt->bindParam(':species'    , $species    );
    $stmt->bindParam(':age'        , $age        );
    $stmt->bindParam(':sex'        , $sex        );
    $stmt->bindParam(':size'       , $size       );
    $stmt->bindParam(':color'      , $color      );
    $stmt->bindParam(':location'   , $location   );
    $stmt->bindParam(':description', $description);
    $stmt->execute();
}

/**
 * Get pet main photo
 *
 * @param integer $id   Pet ID
 * @return string       URL of pet main photo
 */
function getPetMainPhoto(int $id) : string {
    global $db;
    $stmt = $db->prepare('SELECT id, url FROM PetPhoto
    WHERE petId=:petId');
    $stmt->bindParam(':petId', $id);
    $stmt->execute();
    $urls = $stmt->fetchAll();

    if(count($urls) == 0) return '';

    $id = $urls[0]['id'];
    $url_ret = $urls[0]['url'];
    foreach($urls as $url){
        if($url['id'] < $id){
            $id = $url['id'];
            $url_ret = $url['url'];
        }
    }
    
    return $url_ret;
}

/**
 * Get comments about a pet.
 *
 * @param integer $id   ID of the pet
 * @return array        Array of comments about that pet
 */
function getPetComments(int $id) : array {
    global $db;
    $stmt = $db->prepare('SELECT *
    FROM Comment
    WHERE pet=:id');
    $stmt->bindParam(':id', $id);;
    $comments = $stmt->fetchAll();
    return $comments;
}

/**
 * Get photos associated to comments about a pet.
 *
 * @param integer $id   ID of the pet
 * @return array        Array of photos in comments about a pet
 */
function getPetCommentsPhotos(int $id) : array {
    global $db;
    $stmt = $db->prepare('SELECT * FROM PetPhotoInComment 
    WHERE commentId IN (SELECT id FROM Comment WHERE id=:id)');
    $stmt->bindParam(':id', $id);;
    $comments = $stmt->fetchAll();
    return $comments;
}

/**
 * Get pets added by a user.
 *
 * @param string $username  User's username
 * @return array            Array of pets added by that user
 */
function getAddedPets(string $username) : array {
    global $db;
    $stmt = $db->prepare('SELECT * FROM Pet 
    WHERE postedBy=:username');
    $stmt->bindParam(':username', $username);;
    $addedPets = $stmt->fetchAll();
    return $addedPets;
}

/**
 * Add adoption request
 *
 * @param string $username  Username of user that created request
 * @param integer $id       ID of pet the adoption request refers to
 * @param string $text      Text of the adoption request
 * @return integer          ID of the adoption request
 */
function addAdoptionRequest(string $username, int $id, string $text) : int {
    global $db;
    $stmt = $db->prepare('INSERT INTO AdoptionRequest
    (user, pet, text)
    VALUES
    (:user, :pet, :text)');
    $stmt->bindParam(':user'       , $username   );
    $stmt->bindParam(':pet'        , $id         );
    $stmt->bindParam(':text'       , $text       );
    $stmt->execute();
    return $db->lastInsertId();
}
