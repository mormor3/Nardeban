<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$count=$_REQUEST["count"];
    if ($count!=0) {
        $stmt = $conn->prepare('UPDATE preOrder set count=:count where productId=:productId');
        $stmt->bindParam(':count', $count);
		$stmt->bindParam(':productId', $_REQUEST["productId"]);
		$stmt->execute();
    } else {
        $stmt = $conn->prepare('select count(id) from preOrder');
        $stmt->execute();
        $orderinformation = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $orderinformation["count(id)"] + 1;

        $stmt = $conn->prepare('INSERT INTO preOrder(id,userId,productId,count) VALUES(:id,:userId,:productId,1)');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':userId', $_REQUEST["userId"]);
        $stmt->bindParam(':productId', $_REQUEST["productId"]);
        $stmt->execute();
    }
    $conn = null;
} catch (PDOException $e) {
    
}
?>