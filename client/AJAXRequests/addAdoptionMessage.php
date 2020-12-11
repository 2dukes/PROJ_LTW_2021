<?php
    require_once('../../server/connection.php');

    $stmt1 = $db->prepare('INSERT INTO AdoptionRequestMessage(text, request, user)
        VALUES(:message, :requestId, :user)');
    
    $stmt1->bindValue(':message', $_POST['Msgtext']);
    $stmt1->bindValue(':requestId', $_POST['requestId']);
    $stmt1->bindValue(':user', $_POST['user']);
    $stmt1->execute();
    $lastInsertedID = $db->lastInsertId();

    $stmt2 = $db->prepare('SELECT text, request, messageDate, user FROM AdoptionRequestMessage WHERE request=:requestId');
    $stmt2->bindValue(':requestId', $_POST['requestId']);
    $stmt2->execute();
    $insertedMsgs = $stmt2->fetchAll();

    $stmt3 = $db->prepare('SELECT pet FROM AdoptionRequest WHERE id =:requestId');
    $stmt3->bindValue(':requestId', $_POST['requestId']);
    $stmt3->execute();
    $petId = $stmt3->fetch();

    $stmt4 = $db->prepare('SELECT name FROM Pet WHERE id =:petId');
    $stmt4->bindValue(':petId', $petId['pet']);
    $stmt4->execute();
    $petName = $stmt4->fetch();

    $data = array(
        'comments' => $insertedMsgs,
        'petId' => $petId,
        'petName' => $petName,
    );

    echo json_encode($data);
    
