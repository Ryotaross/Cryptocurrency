<?php
function add_money($dbh,$userid,$money,$now_date){
    try{
        $sql = 'INSERT INTO atm(user_id,money,create_time) VALUES (?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$money,PDO::PARAM_STR);
        $stmt->bindValue(3,$now_date,PDO::PARAM_STR);
        $stmt->execute();
        set_success('入金しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function get_money_history($dbh,$userid){
    try{
        $sql = 'SELECT id,money,create_time FROM atm WHERE user_id = ? order by create_time desc ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function users_money($dbh,$userid,$total_money,$money){
    $total_money = $total_money + $money;
    try{
        $sql = 'UPDATE users SET money = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$total_money,PDO::PARAM_STR);
        $stmt->bindValue(2,$userid,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}