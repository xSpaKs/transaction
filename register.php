<?php

if (!empty($_POST))
{
    $validator = true;

    if (!isset($_POST["username"]) || empty($_POST["username"]) || !is_string($_POST["username"]))
    {
        $_SESSION["message"] .= "<p>Please type a correct username</p>";
        $validator = false;
    }

    if (!isset($_POST["mail"]) || empty($_POST["mail"]) || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION["message"] .= "<p>Please type a correct mail</p>";
        $validator = false;
    }
    else
    {
        $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
        $query = "SELECT * from `users` WHERE email = ?";
        $queryP = $db->prepare($query);
        $answer = $queryP->execute([
            $_POST["mail"]
        ]);

        if ($queryP->rowCount() != 0)
        {
            $_SESSION["message"] .= "<p>Please use another mail, this one is already registered</p>";
            $validator = false;
        }
    }

    if (!isset($_POST["password"]) || empty($_POST["password"]) || !is_string($_POST["password"]) || strlen($_POST["password"]) < 8)
    {
        $_SESSION["message"] .= "<p>Please type a correct password (at least 8 characters)</p>";
        $validator = false;
    }

    if ($validator == true)
    {
        $hashPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
        $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)";
        $queryP = $db->prepare($query);
        $answer = $queryP->execute([
            $_POST["username"],
            $_POST["mail"],
            $hashPassword
        ]);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <a href="./">Home</a>
    <a href="login">Login</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>
    
    <form action="" method="post">
        <div>
            <label for="username">Username : </label>
            <input type="text" name="username">
        </div>

        <div>
            <label for="username">Mail : </label>
            <input type="mail" name="mail">
        </div>

        <div>
            <label for="username">Password (at least 8 characters) : </label>
            <input type="password" name="password">
        </div>

        <input type="Submit">
    </form>
</body>
</html>