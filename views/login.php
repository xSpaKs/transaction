<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Login</h1>
    <a href="./">Home</a>
    <a href="register">Register</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <form action="" method="post">
        <div>
            <label for="username">Mail : </label>
            <input type="mail" name="mail" value=<?php echo (isset($_POST["mail"]) ? $_POST["mail"] : "")?>>
        </div>

        <div>
            <label for="username">Password (at least 8 characters) : </label>
            <input type="password" name="password" value=<?php echo (isset($_POST["password"]) ? $_POST["password"] : "")?>>
        </div>

        <input type="submit">
    </form>
</body>
</html>