<?php
//get_db_connect()-/coinshop.php
function  change_cart($dbh,$quentity,$id,$userid,$now_date){
    try{
        $sql = 'UPDATE carts SET how_many = ? ,update_date = ? WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$quentity,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_STR);
        $stmt->bindValue(4,$userid ,PDO::PARAM_STR);
        $stmt->execute();
        set_success('数量を変更しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function delete_cart($dbh,$id,$userid){
    try{
        $sql = 'DELETE FROM carts WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->bindValue(2,$userid,PDO::PARAM_STR);
        $stmt->execute();
        set_success('カートから削除しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function get_cart($dbh,$userid){
    try{
        $sql = 'SELECT carts.item_id,items.name,items.img,items.price,items.stock,carts.how_many FROM items
                INNER JOIN carts ON items.id = carts.item_id WHERE carts.user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
