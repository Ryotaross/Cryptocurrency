<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/complete.php';
require_once '../model/rate.php';

$data = array();
$now_date = date('Y-m-d H:i:s');
$_SESSION['error'] = array();

session_start();
session_check();
$username = get_username();

try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    now_rate($dbh,$now_date);
    $data = get_cart($dbh,$userid);
    $total_money = get_total_money($dbh,$userid);
    $sum = get_cart_sum($data);
    buy_check($data,$sum,$total_money);
    if(count($_SESSION['error']) === 0){
        $dbh->beginTransaction();
        try{
            update_users_coin($dbh,$userid,$data,$now_date);
            buying($dbh,$data,$userid,$now_date);
            update_users_money($dbh,$sum,$userid,$now_date,$total_money);
            $dbh->commit();
        }catch(PDOException $e){
            $dbh->rollback();
            $err_msg = $e->getMessage();
        }
    }
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}
include_once '../view/complete.php';