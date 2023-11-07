<?php

if (empty($_SESSION["user"]))
{
    $_SESSION["message"] .= "<p>Please login to create an article</p>";
    header("Location:./login");
    exit;
}

if (!empty($_POST))
{
    $validator = true;
    if (!isset($_POST["title"]) || empty($_POST["title"]))
    {
        $_SESSION["message"] .= "<p>Please select a title for your article</p>";
        $validator = false;
    }

    if (!isset($_POST["content"]) || empty($_POST["content"]))
    {
        $_SESSION["message"] .= "<p>Please select a content for your article</p>";
        $validator = false;
    }

    if ($validator == true)
    {
        $db = new PDO("mysql:dbname=evaldev2;host=127.0.0.1", "root", "root");
        $query = "INSERT INTO `posts` (`user_id`, `title`, `body`) VALUES (?, ?, ?)";
        $queryP = $db->prepare($query);
        $answer = $queryP->execute([
            $_SESSION["user"]["id"],
            $_POST["title"],
            $_POST["content"]
        ]);
        
        header("Location:.././dashboard");
        exit;
    }

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
    <h1>Create an article</h1>
    <a href=".././">Home</a>
    <a href="../dashboard">Dashboard</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <form action="" method="post">
        <div>
            <label for="title">Title : </label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="title">Content : </label>
            <input type="text" name="content">
        </div>
        <input type="submit">
    </form>
</body>
</html>