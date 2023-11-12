

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Create a transaction</h1>
    <a href=".././">Home</a>
    <a href="../transactions">My transactions</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>

    <form action="" method="post">
        <div>
            <label for="title">Label : </label>
            <input type="text" name="label" value=<?php echo (isset($_POST["label"]) ? $_POST["label"] : "")?>>
        </div>

        <div>
            <label for="title">Amount : </label>
            <input type="text" name="amount" value=<?php echo (isset($_POST["amount"]) ? $_POST["amount"] : "")?>>
        </div>
        <input type="submit">
    </form>
</body>
</html>