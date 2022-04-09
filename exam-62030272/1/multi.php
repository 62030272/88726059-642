<?php


isset( $_POST['num1'] ) ? $num1 = $_POST['num1'] : $num1 = "";
isset( $_POST['num2'] ) ? $num2 = $_POST['num2'] : $num2 = "";
// echo $_POST['num1'];
// echo $_POST['num2'];
echo "<centre>สูครคูณแม่ $num1 จำนวน $num2 <br>";
if( !empty( $num1 ) && !empty( $num2 ) ) {
    for( $i=1; $i<=$num2; $i++ ) {
        echo "<br/>{$num1} x {$i} = ".( $num1 * $i );
    }
}

?>