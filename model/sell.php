<?php
function change_sell_coin($dbh,$userid,$sell_id,$how_many,$now_date){
     try{
        $sql = 'UPDATE sell_cart SET how_many = ? ,update_date = ? WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$how_many,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$sell_id,PDO::PARAM_STR);
        $stmt->bindValue(4,$userid ,PDO::PARAM_STR);
        $stmt->execute();
        set_success('数量を変更しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function delete_sell_cart($dbh,$sell_id,$userid){
    try{
        $sql = 'DELETE FROM sell_cart WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$sell_id,PDO::PARAM_STR);
        $stmt->bindValue(2,$userid,PDO::PARAM_STR);
        $stmt->execute();
        set_success('削除しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function get_sell_data($dbh,$userid){
    try{
        $sql = 'SELECT sell_cart.item_id,items.name,items.img,items.price,items.stock,sell_cart.how_many FROM items
                INNER JOIN sell_cart ON items.id = sell_cart.item_id WHERE sell_cart.user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_users_coin_data($dbh,$userid){
    try{
        $sql = 'SELECT item_id,have FROM users_coin WHERE user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function sell_check($users_data,$how_many){
    foreach($users_data as $key => $value){
        $hova_coin = $value['have'];
        if($how_many > $hova_coin){
            set_error('所持コイン数を超えています');
        }
    }
}