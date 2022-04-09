<?php
require_once("movieconfig.php");


if ($_POST){
    
    $mvname = $_POST['mvname'];
    $mvrev = $_POST['mvrev'];
    $mvyear = $_POST['mvyear'];
 
    $sql = "INSERT 
            INTO movies (mv_name, mv_revenue, mv_year) 
            VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $mvname, $mvrev, $mvyear);
    $stmt->execute();

    // redirect ไปยัง actor.php
    //header("location: newdocdb.php?id=".$mysqli->insert_id);
    header("location: movie_list.php");
}
?>