<?php

include "../models/User.php";
include "../models/Transaction.php";

if (!isUserConnected())
{
    $_SESSION["message"] .= "<p>Please login to delete a transaction</p>";
    header("Location:.././login");
    exit;
}

if (empty($_GET["id"]))
{
    $_SESSION["message"] .= "<p>Please select a transaction to delete</p>";
    header("Location:.././transactions");
    exit;
}

$transactionFromBdd = getTransactionByID($_GET["id"]);

if ($transactionFromBdd == null) {
    $_SESSION["message"] .= "<p>Please select an existing transaction to delete</p>";
    header("Location:.././transactions");
    exit;
}

if ($transactionFromBdd["user_id"] != $_SESSION["user"]["id"])
{
    $_SESSION["message"] .= "<p>You cannot delete a transaction which is not yours</p>";
    header("Location:.././transactions");
    exit;
}

deleteTransaction($_GET["id"]);

$_SESSION["message"] .= "<p>Your transaction has been deleted</p>";
header("Location:.././transactions");
exit;

?>