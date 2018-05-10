<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select * from users join userdetails on users.id=userdetails.id where username=:username');
    $stmt->bindParam(':username', $_POST["userName"]);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo 'there is an similar username';
    } else {
        echo 'not exist';
    }
    $conn = null;
} catch (PDOException $e) {
    
}
?>