<?php

if (!empty($_POST))
{
    if (isset($_POST["mail"]) && !empty($_POST["mail"]) && isset($_POST["password"]) && !empty($_POST["password"]))
    {
        $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
        $query = "SELECT * FROM users WHERE email = ?";
        $queryP = $db->prepare($query);
        $answer = $queryP->execute([
            $_POST["mail"]
        ]);

        if ($queryP->rowCount() == 1)
        {
            $userFromBdd = $queryP->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST["password"], $userFromBdd["password"]))
            {
                $_SESSION["user"] = $userFromBdd;
                header("Location:./");
                exit;
            }
            else
            {
                $_SESSION["message"] .= "<p>Your mail and/or password is not correct</p>";
            }
        }
        else
        {
            $_SESSION["message"] .= "<p>Your mail and/or password is not correct</p>";
        }
    }
    else
    {
        $_SESSION["message"] .= "<p>Please type a mail and a password</p>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <a href="./">Home</a>
    <a href="register">Register</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <form action="" method="post">
        <div>
            <label for="username">Mail : </label>
            <input type="mail" name="mail">
        </div>

        <div>
            <label for="username">Password (at least 8 characters) : </label>
            <input type="password" name="password">
        </div>

        <input type="submit">
    </form>
</body>
</html>