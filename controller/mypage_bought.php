<?php

require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/mypage.php';
require_once '../model/rate.php';

$data = array();
$mydata =array();
$now_date = date('Y-m-d H:i:s');
$mydata_sum = 0;
$total_money = 0;
$in_money = 0;

//セッションの確認
session_start();
session_check();
$username = get_username();

//購入履歴の取得
try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    $mydata = get_my_data($dbh,$userid);
    now_rate($dbh,$now_date);
    $mydata_sum = get_mydata_sum($mydata);
    $data = get_buy_history($dbh,$userid);
    $total_money = get_total_money($dbh,$userid);
    $in_money = get_in_money($dbh,$userid);
    $compare = $mydata_sum + $total_money - $in_money;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('sell')){
            $id = get_post_data('sell_id');
            adding_sell_cart($dbh,$userid,$id,$now_date);
        }
    }
}catch(PDOException $e){
    $_SESSION['error'] = $e->getMessage();
}
include_once '../view/mypage_bought.php';