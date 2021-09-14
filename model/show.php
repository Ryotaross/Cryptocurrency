<?php 
require_once '../model/coinshop.php';
function get_show_items($dbh,$id){
    try{
        $sql = 'SELECT id,name,price,img,exp,stock,status,img from items WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_show_review($dbh,$id){
    try{
        $sql = 'SELECT coin_review.id,users.username,coin_review.text,coin_review.create_date,users.sex 
        from coin_review INNER JOIN users ON users.id = coin_review.user_id WHERE coin_review.item_id = ? ORDER BY coin_review.create_date desc LIMIT 5';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function throw_review($dbh,$userid,$id,$comment,$now_date){
    try{
        $sql = 'INSERT coin_review(user_id,item_id,text,create_date,update_date) VALUES(?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->bindValue(3,$comment,PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
        $stmt->execute();
        set_success('レビューを投稿しました');
    }catch(PDOException $e){
        throw $e;
    }
}
