<?php
$a = array("authorID"=>1000,"author"=>"mepong", "penname"=>"มีป่อง");
$b = array("authorID"=>1001,"author"=>"makam", "penname"=>"มะขาม");
$c = array("authorID"=>1002,"author"=>"dada", "penname"=>"ดาด้า");

$d = array($a, $b, $c);

echo json_encode($d);

?>