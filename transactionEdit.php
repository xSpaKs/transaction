<?php

if (empty($_SESSION["user"]))
{
    $_SESSION["message"] .= "<p>Please login to update an article</p>";
    header("Location:.././login");
    exit;
}

if (empty($_GET["id"]))
{
    $_SESSION["message"] .= "<p>Please select an article</p>";
    header("Location:.././dashboard");
    exit;
}

$db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
$query = "SELECT * from posts WHERE id = ?";
$queryP = $db->prepare($query);
$answer = $queryP->execute([
    $_GET["id"]
]);

if (!$queryP->rowCount() == 1)
{
    $_SESSION["message"] .= "<p>Please select a valid article</p>";
    header("Location:.././dashboard");
    exit;
}

$post = $queryP->fetch(PDO::FETCH_ASSOC);

if ($post["user_id"] != $_SESSION["user"]["id"])
{
    $_SESSION["message"] .= "<p>You need to own an article in order to edit it</p>";
    header("Location:.././dashboard");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit an article</h1>
    <a href=".././">Home</a>
    <a href="../dashboard">Dashboard</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>
    
    <form action="./update" method="post">
        <div>
            <label for="title">Title : </label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="title">Content : </label>
            <input type="text" name="content">
        </div>

        <div>
            <input type="hidden" name="id" value=<?=$_GET["id"]?>>
        </div>
        <input type="submit">
    </form>
</body>
</html>