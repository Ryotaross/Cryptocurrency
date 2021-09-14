<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/money.php';

$data = array();
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();

try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    $total_money = get_total_money($dbh,$userid);
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(is_POST('atm')){
            $money = get_post_data('money');
            number_check($money,'金額');
            if(count($_SESSION['error']) === 0){
                add_money($dbh,$userid,$money,$now_date);
                users_money($dbh,$userid,$total_money,$money);
            }
        }
    }
    $data = get_money_history($dbh,$userid);
    $total_money = get_total_money($dbh,$userid);
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}
include_once '../view/money.php';