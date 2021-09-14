<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/rate.php';
require_once '../model/show.php';

$id = $_GET['show_id'];
$data = array();
$review = array();
$err_msg = array();
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();
$_SESSION['error'] = [];

//DBとの接続
try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    now_rate($dbh,$now_date);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('cart')){
            adding_cart($dbh,$userid,$id,$now_date);
        }else if(is_POST('throw')){
            $comment = get_post_data('comment');
            word_check($comment,'レビュー');
            if(count($_SESSION['error']) === 0){
                throw_review($dbh,$userid,$id,$comment,$now_date);
            }
        }
    }
    $data = get_show_items($dbh,$id);
    $review = get_show_review($dbh,$id);
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}

include_once '../view/show.php';