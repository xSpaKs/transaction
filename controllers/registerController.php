<?php

include "../models/User.php";

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
        $userFromBdd = getUserFromEmail($_POST["mail"]);

        if ($userFromBdd != null)
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
        insertUserToDB($_POST["username"], $_POST["mail"], $_POST["password"]);
        $_SESSION["message"] .= "<p>You have successfully been registered</p>";
        header("Location:./login");
        exit;
    }
}

include "../views/register.php";

?>