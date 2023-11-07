<?php

if (empty($_SESSION["user"]))
{
    $_SESSION["message"] .= "<p>Please login to update an article</p>";
    header("Location:.././login");
    exit;
}

if (!empty($_POST))
{
    if (!isset($_POST["title"]) || empty($_POST["title"]))
    {
        $_SESSION["message"] .= "<p>Please select a title for your article</p>";
        header("Location:./edit?id=". $_POST["id"]);
        exit;
    }

    if (!isset($_POST["content"]) || empty($_POST["content"]))
    {
        $_SESSION["message"] .= "<p>Please select a content for your article</p>";
        header("Location:./edit?id=". $_POST["id"]);
        exit;
    }

    $db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
    $query = "UPDATE `posts` SET `title`= ?, `body`= ?, updated_at = current_timestamp WHERE id = ?";
    $queryP = $db->prepare($query);
    $answer = $queryP->execute([
        $_POST["title"],
        $_POST["content"],
        intval($_POST["id"])
    ]);
    header("Location:.././dashboard");
    exit;

}


?>