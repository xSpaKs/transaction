<?php

include "../models/User.php";
include "../models/Transaction.php";

if (!isUserConnected())
{
    $_SESSION["message"] .= "<p>Please login to create a transaction</p>";
    header("Location:../login");
    exit;
}

if (!empty($_POST))
{
    $validator = true;
    if (!isset($_POST["label"]) || empty($_POST["label"]))
    {
        $_SESSION["message"] .= "<p>Please select a label for your transaction</p>";
        $validator = false;
    }

    if (!isset($_POST["amount"]) || empty($_POST["amount"]))
    {
        $_SESSION["message"] .= "<p>Please select an amount for your transaction</p>";
        $validator = false;
    }
    else if (!is_numeric($_POST["amount"])) 
    {
        $_SESSION["message"] .= "<p>The amount must be an integer value</p>";
        $validator = false;
    }

    if ($validator == true)
    {
        insertTransactionIntoDB($_SESSION["user"]["id"], $_POST["label"], round($_POST["amount"]));
        header("Location:.././transactions");
        exit;
    }

}

include "../views/transactionCreate.php";

?>
