<?php
    header("Access-Control-Allow-Origin:*");
    $arr = ['石头','剪刀','布'];
    $s = rand(0,2);
    $me = $arr[$s];
    $you = isset($_GET['caiquan']) ? $_GET['caiquan'] : (isset($_POST['caiquan']) ? $_POST['caiquan'] : "石头");
    if(!isset($_GET['caiquan']) && !isset($_POST['caiquan'])){
        $you = "石头" ;
        $me = "布" ;
    }
    echo "{\"me\":\"$me\",\"you\":\"$you\"}";
?>