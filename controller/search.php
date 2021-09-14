<?php
require_once '../conf/const.php';
require_once '../model/search.php';
require_once '../model/coinshop.php';
require_once '../model/rate.php';

$letter = $_GET['letter'];
$success = array();
$err_msg = array();
$user = array();
$data = array();
$userdata = array();
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();

try{
    $dbh = get_db_connect();
    now_rate($dbh,$now_date);
    $data = get_items($dbh,$letter);
    $userid = get_user_id($dbh,$username);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('cart')){
            $id = get_post_data('buy_id');
            adding_cart($dbh,$userid,$id,$now_date);
        }
    }
   
    
}catch (PDOException $e){
    $err_msg = $e->getMessage();
}

include_once '../view/index.php';