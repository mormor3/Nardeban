<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select * from products as pr join productdetails as pd on pr.id=pd.productid join productoptions as po on pd.productid=po.productid where pr.id=:id');
    $stmt->bindParam(':id', $_REQUEST["id"]);
    $stmt->execute();
    $resultdetails = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<table style="width: 100%;border:1px black solid">';
    echo '<tr><th>نام محصول</th><th>' . $resultdetails["name"] . '</th></tr>';
    echo '<tr><th>وزن</th><th>' . $resultdetails["weight"] . ' گرم'.' </th></tr>';
    echo '<tr><th>شرکت</th><th>' . $resultdetails["company"] . '</th></tr>';
    echo '<tr><th>رنگ</th><th>' . $resultdetails["color"] . '</th></tr>';
    echo '<tr><th>قیمت</th><th>' . $resultdetails["price"] . 'ریال '.' </th></tr>';
    echo '<tr><th>توضیحات</th><th>' . $resultdetails["productdescription"] . '</th></tr>';
    echo '</table>';
    echo '<input type="button" value="خروج" onclick="exitDetail()">';

    $conn = null;
} catch (PDOException $e) {
    
}
?>