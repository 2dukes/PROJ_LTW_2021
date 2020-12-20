<?php
    $user = User::fromDatabase($_SESSION['username']);
    $added_pets = $user->getAddedPets();
    $adoption_requests = $user->getAdoptionRequestsToOthers();
    if (!checkIfAdopted($pet->getId())) {
        if (!in_array($pet, $added_pets)) { 
            if (!userRequestedPet($_SESSION['username'], $pet->getId())) { ?>
                <div id="propose"><a href="pet/<?= $pet->getId() ?>/adopt"> <img src="rest/client/resources/img/adopt-me.png" height="100px" width="100px"> </a></span>
    <?php } else { 
                if (getAdoptionRequestOutcome($_SESSION['username'], $pet->getId()) === 'pending') { ?>
                    <button id="remove-proposal"><a href="actions/remove_proposal.php?csrf=<?=$_SESSION['csrf']?>&id=<?= $pet->getId() ?>" onclick="return confirm('Do you want to remove the adoption request?')"> <img src="rest/client/resources/img/remove-proposal.svg" height="30px">Remove Proposal</a></button>
                <?php } else if (getAdoptionRequestOutcome($_SESSION['username'], $pet->getId()) === 'rejected') { ?>
                    <div id="rejected-proposal">The proposal was rejected 😿 </div>
                    <div id="propose"><a href="pet/<?= $pet->getId() ?>/adopt"> <img src="rest/client/resources/img/adopt-me.png" height="100px" width="100px"> </a></span>
                <?php } else if (getAdoptionRequestOutcome($_SESSION['username'], $pet->getId()) === 'accepted') { ?>
                    <div id="rejected-proposal">The proposal was accepted! 😺</div>
                <?php }
                }
            }
    } else if ($_SESSION['username'] !== $pet->getPostedBy()) {
        $userWhoAdoptedPet = Pet::fromDatabase($pet->getId())->getAdoptedBy();
        if ($userWhoAdoptedPet->getUsername() == $_SESSION['username']) { ?>
                    <div id="rejected-proposal">The proposal was accepted! Have fun with your new pet! 😺</div>
        <?php } else { ?>
        <div id="pet-already-adopted">The pet was already adopted by <a href="user/<?=$userWhoAdoptedPet->getUsername()?>"><?=$userWhoAdoptedPet->getUsername()?></a> </div>
    <?php } }