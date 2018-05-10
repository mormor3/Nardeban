<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select pr.id,name,count,po.productId,price from preOrder as po join products as pr on po.productId=pr.id join productoptions as pro on pr.id=pro.id where userId=:userId');
    $stmt->bindParam(':userId', $_REQUEST["userId"]);
    $stmt->execute();
    $userOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table style="width: 100%;border:1px black solid">';
    echo '<tr><th>ردیف</th><th>نام محصول</th><th>تعداد</th><th>قیمت</th><th>قیمت کل</th></tr>';
    $i = 1;
    $sum = 0;
    foreach ($userOrders as $userOrder) {
        echo '<tr id=' . $userOrder["id"] . '><th>' . $i . '</th><th>' . $userOrder["name"] . '</th>';
        echo '<th><input type="number" value=' . $userOrder["count"] . ' id="product' . $userOrder["productId"] . '" onchange="updatePurchase('.$userOrder["productId"].')"></th>';
        echo '<th>' . $userOrder["price"] . '</th><th>' . $userOrder["price"] * $userOrder["count"] . '</th></tr>';
        $sum = $sum + $userOrder["price"]* $userOrder["count"];
        $i = $i + 1;
    }
    echo '<tr><th>' . $i . '</th><th>جمع</th><th></th><th></th><th>' . $sum . '</th></tr>';
    echo '</table>';
    echo '<input type = "button" value = "خروج" onclick = "exitDetail()">';

    $conn = null;
} catch (PDOException $e) {
    
}
?>