<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1>My transactions</h1>
    <a href="./">Home</a>
    <?php

if (!empty($_SESSION["user"]))
{ ?>
        <a href="transactions/create">Create a transaction</a>   
        <a href="logout">Logout</a>  
    <?php 
    } ?>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <?php
    if ($transactionReadOnly != null)
    { ?>
        <div>
            <p>----------</p>
            <p><?=date("d/m/y H:i:s", strtotime($transactionReadOnly["updated_at"]))?></p>
            <p><?=$transactionReadOnly["label"]?></p>
            <p><?=$transactionReadOnly["username"]?></p>
            <p><?=$transactionReadOnly["amount"]?></p>
        </div>
    <?php }
    
    else if (isset($allTransactions) && !empty($allTransactions))
    {
        foreach($allTransactions as $transaction)
        { ?>
            <div>
                <p>----------</p>
                <p><?=date("d/m/y H:i:s", strtotime($transaction["updated_at"]))?></p>
                <p><?=$transaction["label"]?></p>
                <p><?=$transaction["username"]?></p>
                <p><?=$transaction["amount"]?></p>
                <a href="transactions/edit?id=<?=$transaction["id"]?>">Edit the transaction</a>
                <a href="transactions/delete?id=<?=$transaction["id"]?>">Delete the transaction</a>
            </div>
        <?php }
    } 
    else
    { ?>
        <p>You do not have any transactions yet</p>
    <?php } ?>

</body>
</html>