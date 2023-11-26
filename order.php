<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--form users-->
<form action="save.php">
    <p>Please select your user:</p>
    <?php
    extract($_REQUEST, EXTR_PREFIX_SAME, "dup");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "makeen";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare(
        "SELECT * FROM users");
    $stmt->execute();
    $users = $stmt;
    foreach ($stmt->fetchall() as $user):?>
    <input type="radio" name="user" value="<?php echo $user['id']; ?>" id="<?php echo $user['id']; ?>">
    <label><?php echo $user['name']; ?></label><br>
    <?php endforeach; ?>
    <p>Please select your product:</p>
    <?php
    $stmt = $conn->prepare(
        "SELECT * FROM products");
    $stmt->execute();
    foreach ($stmt->fetchall() as $products): ?>
        <input type="checkbox" name="product[]" value="<?php echo $products['id']; ?>" id="<?php echo $products['id']; ?>">
        <label><?php echo $products['productname']; ?></label><br>
    <?php endforeach; ?>
    <br>
        <button type="submit" name="submit">add to orders </button>
    <br>
</form>
</body>
</html>
