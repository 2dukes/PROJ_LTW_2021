<?php
    function drawPetProposal($reqId, $name, $adoptionMessage, $petId, $user, $outcome, $reqDate, $isMyPetProposal) { 
        if($outcome == 'pending') { ?>
            <div id="proposal"> 
                <?php if($isMyPetProposal) { ?>
                    <div id="proposal-header">
                        <a href="profile.php?username=<?=$user?>">
                            <img id="proposal-pic" src="../server/resources/img/profiles/<?=$user?>.jpg">
                        </a>
                    </div>
                <?php } ?>
            <div id="proposal-info">
                <?php if($isMyPetProposal) { ?>
                    <p><?=$user?> on <?=$reqDate?> for <a id="proposal-pet" href="pet.php?id=<?=$petId?>"><?=$name?></a></p>
                <?php } else { ?>
                    <p><?=$reqDate?> for <a id="proposal-pet" href="pet.php?id=<?=$petId?>"><?=$name?></a></p>
                <?php } ?>
                
                <div id="proposal-message">
                    <textarea readonly><?=$adoptionMessage?></textarea>
                </div>  
                
                <?php if($isMyPetProposal) { ?>
                    <button onclick="location.href='<?= SERVER_URL ?>/actions/change_adoptionRequest_outcome.php?requestId=<?=$reqId?>&username=<?=$_SESSION['username']?>&outcome=accepted&petId=<?=$petId?>'" id="acceptRequest">Accept Request</button>
                    <button onclick="location.href='requestAdoption.php?id=<?=$reqId?>'"id="answerRequest">Answer Request</button>
                    <button onclick="location.href='<?= SERVER_URL ?>/actions/change_adoptionRequest_outcome.php?requestId=<?=$reqId?>&username=<?=$_SESSION['username']?>&outcome=rejected'" id="refuseRequest">Refuse Request</button>
                <?php } else { ?>
                    <button onclick="location.href='<?= SERVER_URL ?>/actions/remove_proposal.php?id=<?=$petId?>'"id="cancelRequest">Cancel Request</button>
                <?php } ?>

            </div>
        </div>
       <?php } ?>  
    <?php } ?>

    <?php 

    function drawProposals($adoptionRequests) {
        foreach($adoptionRequests as $adoptionReq) {
            if ($adoptionReq['outcome'] !== 'accepted')
                drawPetProposal($adoptionReq['requestId'], $adoptionReq['name'], $adoptionReq['text'], $adoptionReq['id'],
                    $adoptionReq['user'], $adoptionReq['outcome'], $adoptionReq['requestDate'], true);
            }    
    }

    function drawMyProposals($adoptionRequests) {
        foreach($adoptionRequests as $adoptionReq) 
            drawPetProposal($adoptionReq['id'], $adoptionReq['name'], $adoptionReq['text'], $adoptionReq['id'],
                $adoptionReq['user'], $adoptionReq['outcome'], $adoptionReq['requestDate'], false);
    }