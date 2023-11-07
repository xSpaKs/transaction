<?php

if (empty($_SESSION["user"]))
{
    $_SESSION["message"] .= "<p>Please login to delete an article</p>";
    header("Location:.././login");
    exit;
}

if (empty($_GET["id"]))
{
    $_SESSION["message"] .= "<p>Please select an article to delete</p>";
    header("Location:.././dashboard");
    exit;
}

$db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
$query = "SELECT * FROM posts WHERE posts.id = ?";
$queryP = $db->prepare($query);
$answer = $queryP->execute([
    $_GET["id"]
]);

if ($queryP->rowCount() != 1)
{
    $_SESSION["message"] .= "<p>Please select an existing article to delete</p>";
    header("Location:.././dashboard");
    exit;
}

$post = $queryP->fetch(PDO::FETCH_ASSOC);

if ($post["user_id"] != $_SESSION["user"]["id"])
{
    $_SESSION["message"] .= "<p>You cannot delete an article which is not yours</p>";
    header("Location:.././dashboard");
    exit;
}

$db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
$query = "DELETE FROM posts WHERE posts.id = ?";
$queryP = $db->prepare($query);
$answer = $queryP->execute([
    $_GET["id"]
]);

$_SESSION["message"] .= "<p>Your article has been deleted</p>";
header("Location:.././dashboard");
exit;

?>