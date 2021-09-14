<?php
require_once '../model/coinshop.php';
function admin_check(){
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] === 'admin'){
            header('Location:tool.php');
            exit;
        }else{
            header('Location:top.php');
            exit;
    }
}
}
function name_cookie(){
    if(isset($_COOKIE['name'])){
        $name = $_COOKIE['name'];
    } else {
        $name = '';
    }
}
function get_login_info($dbh,$name){
    try{
        $sql = 'SELECT username,password FROM users WHERE username = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$name,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function usercheck($data){
    if(!isset($data[0]['username'])){
        set_error('このユーザー名は存在しません');
    }
}
function login_check($data,$passwd,$name){
    if($data[0]['password'] === $passwd){
        if($data[0]['username'] === 'admin'){
            $_SESSION['username'] = $data[0]['username'];
            header('Location:tool.php');
        }else{
            $_SESSION['username'] = $data[0]['username'];
            header('Location:top.php');
        }
    }else{
        set_error( 'ユーザー名とパスワードが一致しません');
    }
}