<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/register.php';

$now_date = date('Y-m-d H:i:s');
$err_msg = array();
$double = array();

session_start();
$_SESSION['error'] = [];

try{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //POST値の受け取り
        $dbh = get_db_connect();
        $mail = get_post_data('mail');
        $name = get_post_data('name');
        $passwd = get_post_data('passwd');
        $sex = get_post_data('sex');
        $birth = get_post_data('birth');
        //登録処理
        register_check($mail,$name,$passwd);
        if(count($_SESSION['error']) === 0){
           double_error($dbh,$name);
        }
       
        if(count($_SESSION['error']) === 0){
            register_users($dbh,$name,$mail,$passwd,$sex,$birth,$now_date);
            header('Location:./register_complete.php');
        }
    }
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}

include_once '../view/register.php';