<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
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
    
    <?php
    if (!empty($_SESSION["user"]))
    { ?>
        <a href="transactions">My transactions</a>   
        <a href="logout">Logout</a> 
    <?php 
    } ?>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>
</body>
</html>