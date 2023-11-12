<?php

include "../models/User.php";
include "../models/Transaction.php";

if (!isUserConnected())
{
    $_SESSION["message"] .= "<p>Please login to access your dashboard</p>";
    header("Location:./login");
    exit;
}

$transactionReadOnly = null;
$allTransactions = [];

if (isset($_GET["id"]) && !empty($_GET["id"]))
{
    $transactionReadOnly = getTransactionByID($_GET["id"]);
    
    if ($transactionReadOnly == null)
    {
        $_SESSION["message"] .= "<p>Please select an existing transaction to read</p>";
    }

}
else {
    $allTransactions = getAllTransactionsFromUser($_SESSION["user"]["id"]);
}

include "../views/transaction.php";

?>