<?php

function  post_article($dbh,$title,$article,$userid,$now_date){
    try{
        $sql = 'INSERT blog(user_id,title,article,count,create_date,update_date) VALUES(?,?,?,0,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$title,PDO::PARAM_STR);
        $stmt->bindValue(3,$article,PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
        $stmt->execute();
        set_success('体験談を投稿しました。');
    }catch(PDOException $e){
        throw $e;
    }
}