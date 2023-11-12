<?php

include "../models/User.php";

if (!empty($_POST))
{
    if (isset($_POST["mail"]) && !empty($_POST["mail"]) && isset($_POST["password"]) && !empty($_POST["password"]))
    {
        $userFromBdd = getUserFromEmail($_POST["mail"]);

        if ($userFromBdd != null) {
            if (password_verify($_POST["password"], $userFromBdd["password"])) {
                $_SESSION["user"] = $userFromBdd;
                header("Location:./");
                exit;
            } else {
                $_SESSION["message"] .= "<p>Your mail and/or password is not correct</p>";
            }
        } else {
            $_SESSION["message"] .= "<p>This user does not exist</p>";
        }
        
    }
    else
    {
        $_SESSION["message"] .= "<p>Please type a mail and a password</p>";
    }
}

include "../views/login.php";

?>