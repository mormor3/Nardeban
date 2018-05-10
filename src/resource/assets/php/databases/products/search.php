<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitekala";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select pr.id,name,groupdetailid,sum(countofsell) from products as pr join productoptions as pro on pr.id=productid where name like "%' . $_REQUEST["searchString"] . '%" group by 1 order by 4 desc;');
    $stmt->execute();
    $resultproducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo count($resultproducts) . " ";
    $i = 1;
    foreach ($resultproducts as $product) {
		
        $stmt = $conn->prepare('SELECT * FROM productdetails AS pd JOIN productoptions AS po ON pd.productid=po.productid WHERE pd.productid=:id');
        $stmt->bindParam(':id', $product["id"]);
        $stmt->execute();
        $resultoptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
        $minPrice = 1000000000;
        $available = 0;
        $colors = "";
		$imageURLs = "";
        foreach ($resultoptions as $options) {
            $minPrice = min($minPrice, $options["price"]);
            if ($available == 0 && $options["countofavailableproduct"] > 0) {
                $available = 1;
            }
            $company = $options["company"];
            $colors = $colors . ' ' . $options["color"];
			$imageURLs = options["imageurl"];
        }
		
		$name[i] = $product["name"];
		$imageURL[i] = $imageURLs
		$color[i] = $colors;
		$price[i] = "" + $minPrice;
		
        $i = $i + 1;
    }

	$myObj->name = $name;
	$myObj->imageURL = $imageURL;
	$myObj->color = $colors;
	$myObj->minPrice = $minPrice;

	echo json_encode($myObj);
	
    $conn = null;
} catch (PDOException $e) {
    
}
?>