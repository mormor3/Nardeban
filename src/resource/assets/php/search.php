<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select pr.id,name,groupdetailid,sum(countofsell) from products as pr join productoptions as pro on pr.id=productid where name like "%' . $_REQUEST["searchString"] . '%" group by 1 order by 4 desc;');
    $stmt->execute();
    $resultproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    foreach ($resultproducts as $product) {
		
        $stmt = $conn->prepare('SELECT * FROM productdetails AS pd JOIN productoptions AS po ON pd.productid=po.productid WHERE pd.productid=:id');
        $stmt->bindParam(':id', $product["id"]);
        $stmt->execute();
        $resultoptions = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$ids[] = $product["pr.id"];
		$names[] = $product["name"];
		$imageURLs[] = $resultoptions["imageurl"];
		$colors[] = $resultoptions["color"];
		$prices[] = $resultoptions["price"];
		$companies[] = $resultoptions["company"];
		
        $i = $i + 1;
    }

	$myObj->ids = $ids;
	$myObj->names = $names;
	$myObj->imageURLs = $imageURLs;
	$myObj->colors = $colors;
	$myObj->prices = $prices;
	$myObj->companies = $companies;

	echo json_encode($myObj);
	
    $conn = null;
} catch (PDOException $e) {
    
}
?>