<?php

include "../models/User.php";
include "../models/Transaction.php";

if (!isUserConnected())
{
    $_SESSION["message"] .= "<p>Please login to update a transaction</p>";
    header("Location:.././login");
    exit;
}

if (empty($_GET["id"]))
{
    $_SESSION["message"] .= "<p>Please select a transaction</p>";
    header("Location:.././transactions");
    exit;
}

$transactionFromBdd = getTransactionByID($_GET["id"]);

if ($transactionFromBdd == null) 
{
    $_SESSION["message"] .= "<p>Please select a valid article</p>";
    header("Location:.././transactions");
    exit;
}

if ($transactionFromBdd["user_id"] != $_SESSION["user"]["id"])
{
    $_SESSION["message"] .= "<p>You need to own a transaction in order to edit it</p>";
    header("Location:.././transactions");
    exit;
}

include "../views/transactionEdit.php";
?>