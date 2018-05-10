<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "sitekala";

try {
    // Create connection
    $conn = new mysqli($serverName, $username, $password, $dbName);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM groups";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<dt>" . $row["name"] . "</dt>";
            $sql = "SELECT * FROM groupdetails where groupid=" . $row["id"];
            $tresult = $conn->query($sql);
            if ($tresult->num_rows > 0) {
                while ($trow = $tresult->fetch_assoc()) {
                    echo "<dd onclick=\"show(\"" . $trow["name"] . "\")\">* " . $trow["name"] . "</dd>";
                }
            }
        }
    }

    $conn->close();

} catch (PDOException $e) {
}
?>