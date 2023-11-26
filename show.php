<?php
$servername = "localhost";
$username = "root";
$dbname = "makeen";
$password = "" ;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {$sql = $conn->prepare("SELECT users.id , users.name ,orders.id , products.productname
                                FROM orders 
                                INNER JOIN users ON orders.user_id = users.id
                                INNER JOIN pivot ON orders.id = pivot.order_id 
                                INNER JOIN products ON pivot.product_id = products.id ORDER BY orders.id DESC");
    $sql->execute();
    $orders = $sql->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e) {
    echo "error"  . "<br>" . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>order</th>
        <th>user</th>
        <th>product</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orders as $order){
        $orderid = $order['id'];
        $user = $order['name'];
        $proname = $order['productname'];
        $td = '<td>';
        $tdc = '</td>';
        echo '<tr>';
        echo $td.$orderid.$tdc;
        echo $td.$user.$tdc;
        echo $td.$proname.$tdc;
        echo '</tr>';
    }
    ?>
    </tbody>
</table>

</body>
</html>

