<?php
require_once '../model/coinshop.php';

function register_check($mail,$name,$passwd){
    $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD';
    if(empty($mail)){
       set_error('メールアドレスを入力してください');
    }else if(preg_match($pattern,$mail) === false){
        set_error('メールアドレスを正しい形式で入力してください');
    }
    $pattern = '/^[0-9a-zA-z]{6,}$/';
    if(empty($name)){
        set_error('ユーザ名を入力してください');
    }else if(preg_match($pattern,$name) !== 1){
        set_error('ユーザ名は半角英数字６文字以上で入力してください');
    }
    $pattern = '/^[0-9a-zA-z]{6,}$/';
    if(empty($passwd)){
        set_error('パスワードを入力してください');
    }else if(preg_match($pattern,$passwd) !== 1){
        set_error('パスワードは半角英数字６文字以上で入力してください');
    }
}
function double_check($dbh,$name){
    try{
        $sql = 'SELECT username from users where username = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$name,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function double_error($dbh,$name){
    $double = array();
    $double = double_check($dbh,$name);
    if(count($double) !== 0){
        set_error('このユーザー名は使用されています');
    }
}
function register_users($dbh,$name,$mail,$passwd,$sex,$birth,$now_date){
    try{
        $sql = 'INSERT INTO users(username,password,mail,sex,birthdate,create_date,update_date)
                VALUES(?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$name,PDO::PARAM_STR);
        $stmt->bindValue(2,$passwd,PDO::PARAM_STR);
        $stmt->bindValue(3,$mail,PDO::PARAM_STR);
        $stmt->bindValue(4,$sex,PDO::PARAM_STR);
        $stmt->bindValue(5,$birth,PDO::PARAM_STR);
        $stmt->bindValue(6,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(7,$now_date,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}