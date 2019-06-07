<?php
require("../includes/dbconnection.php");

$query = "SELECT * FROM Characters ORDER BY level DESC LIMIT 3";
$result = mysqli_query($conn, $query);

$data = array(array("name" => "", "level" => 0), array("name" => "", "level" => 0), array("name" => "", "level" => 0));
for ($i = 0; $i < 3; $i++) {
    $character = mysqli_fetch_assoc($result);
    $data[$i]["name"] = $character["name"];
    $data[$i]["level"] = $character["level"];
}

mysqli_close($conn);

echo json_encode($data);
?>