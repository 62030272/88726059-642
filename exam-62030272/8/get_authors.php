<?php
require_once("authorconfig.php");

if ($_GET) {
    $cat = "%{$_GET['cat']}%";
}
else {
    $cat = "%"; } 

    $sql = "SELECT *
    FROM author
    WHERE authorID  LIKE ? 
    ORDER BY authorID ASC";


    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $cat);
    $stmt->execute();
    $result = $stmt->get_result();

    $dog = array();
    if ($result->num_rows > 0) {
        while ($dog = $result->fetch_object()) {
            $rad[] = $dog;
        }
    }
    
    echo json_encode($rad);



?>