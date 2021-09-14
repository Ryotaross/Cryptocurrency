<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/sell.php';
require_once '../model/rate.php';

$data = array();
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();

try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    $users_data = get_users_coin_data($dbh,$userid);
    now_rate($dbh,$now_date);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('change')){
            $how_many = get_post_data('how_many');
            $sell_id = get_post_data('change_id');
            number_check($how_many,'売却数');
            //sell_check($users_data,$how_many);
            if(count($_SESSION['error']) === 0){
                change_sell_coin($dbh,$userid,$sell_id,$how_many,$now_date);
            }
        }
        if(is_POST('delete')){
            $sell_id = $_POST['delete_id'];
            delete_sell_cart($dbh,$sell_id,$userid);
        }
    }
    $data = get_sell_data($dbh,$userid);
    $sum = get_cart_sum($data);
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}

include_once '../view/sell.php';