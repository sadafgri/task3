<?php
extract($_REQUEST , EXTR_PREFIX_SAME , "dup");

$servername = "localhost";
$username = "root";
$password = "";
$database = "makeen";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("INSERT INTO products (productname)VALUES (:mahsol)");
    $sql->bindParam(':mahsol', $_REQUEST['mahsol']);
    $result=$sql->execute();

} catch(PDOException $e) {

    echo "Connection Failed" .$e->getMessage();
}
