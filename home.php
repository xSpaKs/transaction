<?php 

$db = new PDO("mysql:dbname=transaction;host=127.0.0.1", "root", "root");
$query = "SELECT posts.title, posts.body, posts.updated_at, users.name FROM posts INNER JOIN users ON posts.user_id = users.id";
$queryP = $db->prepare($query);
$answer = $queryP->execute([]);

$allPosts = array_reverse($queryP->fetchAll(PDO::FETCH_ASSOC));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    
    <?php

    if (empty($_SESSION["user"]))
    { ?>
        <a href="login">Login</a>
        <a href="register">Register</a>
    <?php
    } ?>
    
    <a href="articles">Look for an article</a>
    
    <?php
    if (!empty($_SESSION["user"]))
    { ?>
        <a href="dashboard">Dashboard</a>   
        <a href="logout">Logout</a> 
    <?php 
    } ?>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <?php
    foreach($allPosts as $post)
    { ?>
        <div>
            <p>---------</p>
            <p><?=date("d/m/y H:i:s", strtotime($post["updated_at"]))?></p>
            <p><?=$post["title"]?></p>
            <p><?=$post["name"]?></p>
            <p><?=$post["body"]?></p>
        </div>
    <?php }
    ?>
</body>
</html>