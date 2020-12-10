<?php

include_once __DIR__.'/server.php';
include_once SERVER_DIR.'/users.php';
include_once __DIR__.'/pets.php';


/**
 * Add new notification to database.
 *
 * @param string $user          User's username
 * @param string $subject       Notification's subject
 * @param string $text          Notification's subject
 * @return integer              ID of the new notification
 */
function addNotification(string $user, string $subject, string $text) : int {
    global $db;

    $stmt = $db->prepare('INSERT INTO Notification
    (subject, text, user)
    VALUES
    (:subject, :text, :user)');

    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    $notificationId = $db->lastInsertId();

    return $notificationId;
}

/**
 * Get all notifications of the user.
 *
 * @param string $username      User's username
 * @return array                Array containing all user's notifications
 */
function getNotifications($username) : array {
    global $db;

    $stmt = $db->prepare('SELECT
    Notification.id,
    Notification.read,
    Notification.subject,
    Notification.text,
    Notification.user
    FROM Notification INNER JOIN User ON Notification.user=User.username
    WHERE User.username=:username');

    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $userNotifications = $stmt->fetchAll();

    return $userNotifications;
}
