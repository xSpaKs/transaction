<?php

include "../models/User.php";
include "../models/Transaction.php";

if (!isUserConnected())
{
    $_SESSION["message"] .= "<p>Please login to update a transaction</p>";
    header("Location:.././login");
    exit;
}

if (!empty($_POST))
{
    if (!isset($_POST["label"]) || empty($_POST["label"]))
    {
        $_SESSION["message"] .= "<p>Please select a label for your article</p>";
        header("Location:./edit?id=". $_POST["id"]);
        exit;
    }

    if (!isset($_POST["amount"]) || empty($_POST["amount"]))
    {
        $_SESSION["message"] .= "<p>Please select a amount for your article</p>";
        header("Location:./edit?id=". $_POST["id"]);
        exit;
    }
    else if (!is_numeric($_POST["amount"])) 
    {
        $_SESSION["message"] .= "<p>The amount must be an integer value</p>";
        header("Location:./edit?id=". $_POST["id"]);
        exit;
    }

    updateTransaction($_POST["label"], round($_POST["amount"]), intval($_POST["id"]));
    header("Location:.././transactions");
    exit;

}


?>