<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/cart.php';
require_once '../model/rate.php';

$data = array();
$err_msg = array();
$success = array();
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();

try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('change')){
            $quentity = get_post_data('quentity');
            $id = get_post_data('change_id');
            number_check($quentity,'購入数');
            if(count($_SESSION['error']) === 0){
                change_cart($dbh,$quentity,$id,$userid,$now_date);
            }
        }
        if(is_POST('delete')){
            $id = $_POST['delete_id'];
            delete_cart($dbh,$id,$userid);
        }
    }
    now_rate($dbh,$now_date);
    $data = get_cart($dbh,$userid);
    $sum = get_cart_sum($data);
    }catch(PDOException $e){
        $err_msg = $e->getMessage();
    }

include_once '../view/cart.php';