<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select * from users join userdetails on users.id=userdetails.id where username=:username&& password=:password');
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->bindParam(':password', $_POST["password"]);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $userinformation = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<a href="#" onclick="userpanel()">' . $userinformation["firstname"] . ' ' . $userinformation["lastname"] . '</a>';
        echo '<a href="#" onclick="Buyying()">سبد خرید</a>';
    } else {
        echo 'not exist';
    }
    $conn = null;
} catch (PDOException $e) {
    
}
?>