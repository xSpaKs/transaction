<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Edit a transaction</h1>
    <a href=".././">Home</a>
    <a href="../transactions">My transactions</a>

    <?=isset($_SESSION["message"]) ? $_SESSION["message"] : ""; $_SESSION["message"] = ""?>
    
    <form action="./update" method="post">
        <div>
            <label for="title">Label : </label>
            <input type="text" name="label" value="<?php echo $transactionFromBdd["label"] ?>">
        </div>

        <div>
            <label for="title">Amount : </label>
            <input type="text" name="amount" value="<?php echo $transactionFromBdd["amount"] ?>">
        </div>

        <div>
            <input type="hidden" name="id" value=<?=$_GET["id"]?>>
        </div>
        <input type="submit">
    </form>
</body>
</html>