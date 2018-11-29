<?php
//  函数体
$sum=100;
function cal(){
    $sum=0;
    for($i=0;$i<=$sum;$i++){
        $sum+=$i;
    }
    return $sum;
}
$result= cal();
echo $result;
?>