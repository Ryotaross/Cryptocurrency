<?php

require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/login.php';

$data = array();

session_start();
admin_check();
name_cookie();
$_SESSION['error'] = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //POST値の受け取り
    $name = get_post_data('name');
    $passwd = get_post_data('passwd');
    
    word_check($name,'ユーザ名');
    word_check($passwd,'パスワード');
    if(count($_SESSION['error']) === 0){
       setcookie('name' , $name, time() + 60 * 60 * 24 );
       try{
           $dbh = get_db_connect();
           $data = get_login_info($dbh,$name);
           usercheck($data);
           if(count($_SESSION['error']) === 0){
               login_check($data,$passwd,$name);
           }
       }catch(PDOException $e){
           $err_msg = $e->getMessage();
       }
    }
}
include_once '../view/login.php';