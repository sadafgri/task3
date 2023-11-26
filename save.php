<?php

extract($_REQUEST, EXTR_PREFIX_SAME, "dup");

$servername = "localhost";
$username = "root";
$password = "";
$database = "makeen";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $order=$conn->prepare("INSERT INTO orders (user_id) VALUES (?)");
    $order->bindParam(1,$user);
    $order->execute();

    $sql = $conn->prepare("select id from orders ORDER BY  id desc");
    $sql->execute();
    $result = $sql->fetch(\PDO::FETCH_ASSOC);

    foreach ($_REQUEST['product'] as $product){
        $products=$conn->prepare("insert into pivot(order_id,product_id)values (?,?)");
        $order_id=$result['id'];
        $product_id=$product;
        $products->bindParam(1, $order_id);
        $products->bindParam(2, $product_id);
        $products->execute();
    }
} catch (PDOException $e) {

    echo "Connection Failed" . $e->getMessage();
}
