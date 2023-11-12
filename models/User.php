<?php 

function isUserConnected() {
    return empty($_SESSION["user"]) ? false : true;
}

function getUserFromEmail($email) {
    $userFromBdd = null;
    
    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "SELECT * FROM users WHERE mail = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $email
    ]);


    if ($queryP->rowCount() == 1)
    {
        $userFromBdd = $queryP->fetch(PDO::FETCH_ASSOC);
    }

    return $userFromBdd;
}

function insertUserToDB($username, $mail, $password) {
    $hashPassword = password_hash($password, PASSWORD_BCRYPT);

    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "INSERT INTO `users` (`username`, `mail`, `password`) VALUES (?, ?, ?)";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $username,
        $mail,
        $hashPassword
    ]);
}