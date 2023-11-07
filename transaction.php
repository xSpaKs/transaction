<?php

if (empty($_SESSION["user"]))
{
    $_SESSION["message"] .= "<p>Please login to access your dashboard</p>";
    header("Location:./login");
    exit;
}

$db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
$query = "SELECT posts.id, posts.title, posts.body, posts.updated_at, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id = ?";
$queryP = $db->prepare($query);
$answer = $queryP->execute([
    $_SESSION["user"]["id"]
]);

$allPosts = array_reverse($queryP->fetchAll(PDO::FETCH_ASSOC));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h1>My dashboard</h1>
    <a href="./">Home</a>
    <a href="articles">Look for an article</a>   
    <?php

if (!empty($_SESSION["user"]))
{ ?>
        <a href="dashboard/create">Create an article</a>   
        <a href="logout">Logout</a>  
    <?php 
    } ?>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <?php    
    if (isset($allPosts))
    {
        foreach($allPosts as $post)
        { ?>
            <div>
                <p>----------</p>
                <p><?=date("d/m/y H:i:s", strtotime($post["updated_at"]))?></p>
                <p><?=$post["title"]?></p>
                <p><?=$post["name"]?></p>
                <p><?=$post["body"]?></p>
                <a href="dashboard/edit?id=<?=$post["id"]?>">Edit the article</a>
                <a href="dashboard/delete?id=<?=$post["id"]?>">Delete the article</a>
            </div>
        <?php }
    } ?>

</body>
</html>