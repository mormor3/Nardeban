<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select count(id) from users');
    $stmt->execute();
    $userinformation = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $userinformation["count(id)"] + 1;

    $stmt = $conn->prepare('INSERT INTO users(id,username,password) VALUES(:id,:username,:password)');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->bindParam(':password', $_POST["password"]);
    $stmt->execute();

    $stmt = $conn->prepare('INSERT INTO userdetails(id,firstname,lastname,email,phonenumber) VALUES(:id,:firstname,:lastname,:email,:phonenumber)');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':firstname', $_POST["firstname"]);
    $stmt->bindParam(':lastname', $_POST["lastname"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':phonenumber', $_POST["telphone"]);
    $stmt->execute();

    echo 'OK';
    $conn = null;
} catch (PDOException $e) {
    
}
?>