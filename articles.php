<?php

if (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]))
{
    $db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
    $query = "SELECT posts.title, posts.body, posts.updated_at, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        intval($_GET["id"])
    ]);

    if ($queryP->rowCount() == 1)
    {
        $post = $queryP->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
        $_SESSION["message"] .= "<p>Please select an existing article</p>";
    }
}
else
{
    $_SESSION["message"] .= "<p>Please select an article</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Look for an article</title>
</head>
<body>
    <h1>Look for an article</h1>
    <a href="./">Home</a>
    
    <?php
    if (empty($_SESSION["user"]))
    { ?>
        <a href="login">Login</a>
        <a href="register">Register</a>
    <?php
    } 
    else
    { ?>
        <a href="dashboard">Dashboard</a>   
        <a href="logout">Logout</a> 
    <?php 
    } ?>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>
    
    <form action="" method="get">
        <label for="article">What article do you want to see ? </label>
        <input type="text" name="id">
        <input type="submit">
    </form>

    <?php
    
    if (isset($post) && !empty($post))
    { ?>
        <div>
            <p>-----------</p>
            <p><?=date("d/m/y H:i:s", strtotime($post["updated_at"]))?></p>
            <p><?=$post["title"]?></p>
            <p><?=$post["name"]?></p>
            <p><?=$post["body"]?></p>
        </div>
    <?php }    
    ?>
</body>
</html>