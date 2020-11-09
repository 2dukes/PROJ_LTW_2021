<?php
    function drawSingleProposal($name, $adoptionMessage, $petId, $user, $outcome, $reqDate) { 
        if($outcome == 'pending') { ?>
            <div id="proposal"> 
            <div id="proposal-header">
                <a href="profile.php?username=<?=$user?>">
                    <img id="proposal-pic" src="../server/resources/img/profiles/<?=$user?>.jpg">
                </a>
            </div>
            <div id="proposal-info">
                <p><?=$user?> on <?=$reqDate?> for <a id="proposal-pet" href="pet.php?id=<?=$petId?>"><?=$name?></a></p>
                
                <div id="proposal-message">
                    <textarea readonly><?=$adoptionMessage?></textarea>
                </div>  

                <button onclick="location.href='profile.php?username=<?=$_SESSION['username']?>'" id="acceptRequest">Accept Request</button>
                <button id="answerRequest">Answer Request</button>
                <button id="refuseRequest">Refuse Request</button>

            </div>
        </div>
       <?php } ?>  
    <?php } ?>

    <?php function drawProposals($adoptionRequests) {
        foreach($adoptionRequests as $adoptionReq) {
            drawSingleProposal($adoptionReq['name'], $adoptionReq['text'], $adoptionReq['id'], $adoptionReq['user'], $adoptionReq['outcome'], $adoptionReq['requestDate']);
        }
    }