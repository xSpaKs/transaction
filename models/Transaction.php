<?php 

function getTransactionByID($id) {
    $transactionFromBdd = null;

    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "SELECT transactions.id, transactions.user_id, transactions.label, transactions.amount, transactions.updated_at, users.username FROM transactions INNER JOIN users ON transactions.user_id = users.id WHERE transactions.id = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $id
    ]);

    if ($queryP->rowCount() == 1)
    {
        $transactionFromBdd = $queryP->fetch(PDO::FETCH_ASSOC);
    }

    return $transactionFromBdd;
}

function deleteTransaction($id) {
    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "DELETE FROM transactions WHERE transactions.id = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $id
    ]);
}

function getAllTransactionsFromUser($id) {
    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "SELECT transactions.id, transactions.label, transactions.amount, transactions.updated_at, users.username FROM transactions INNER JOIN users ON transactions.user_id = users.id WHERE users.id = ?" ;
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $id
    ]);

    $allTransactionsFromUser = array_reverse($queryP->fetchAll(PDO::FETCH_ASSOC));

    return $allTransactionsFromUser;
}

function insertTransactionIntoDB($id, $label, $amount) {
    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "INSERT INTO `transactions` (`user_id`, `label`, `amount`) VALUES (?, ?, ?)";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $id,
        $label,
        $amount
    ]);
}

function updateTransaction($label, $amount, $id) {
    $db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
    $query = "UPDATE `transactions` SET `label`= ?, `amount`= ?, updated_at = current_timestamp WHERE id = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $label,
        $amount,
        $id
    ]);
}