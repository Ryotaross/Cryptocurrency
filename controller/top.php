<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/top.php';
require_once '../model/rate.php';

$data = array();
$article = array();
$now_date = date('Y-m-d H:i:s');


try{
    $dbh = get_db_connect();
    now_rate($dbh,$now_date);
    $data = get_top_item($dbh);
    $top = get_top_data($dbh);
}catch(PDOException $e){
    throw $e;
}

include_once '../view/top.php';