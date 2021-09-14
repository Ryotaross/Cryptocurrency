<?php
function get_buy_history($dbh,$userid){
    try{
        $sql = 'SELECT bought.item_id,items.name,items.img,bought.price,bought.how_many,bought.bought_date FROM items
                INNER JOIN bought ON items.id = bought.item_id WHERE bought.user_id = ? ORDER BY bought.bought_date desc';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_sell_history($dbh,$userid){
    try{
        $sql = 'SELECT sold.item_id,items.name,sold.price,sold.how_many,sold.create_time FROM items
                INNER JOIN sold ON items.id = sold.item_id WHERE sold.user_id = ? ORDER BY sold.create_time desc';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_my_data($dbh,$userid){
    try{
        $sql = 'SELECT users_coin.have,items.name,items.price,items.id FROM items 
                INNER JOIN users_coin ON items.id = users_coin.item_id WHERE users_coin.user_id = ? 
                ORDER BY items.id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_mydata_sum($data){
    $sum = 0;
    foreach($data as $key => $value){
        $item_sum = $value['price'] * $value['have'];
        $sum += $item_sum;
    }
    return $sum;
}
function get_sell_cart_data($dbh,$userid,$id){
    try{
        $sql = 'SELECT how_many from sell_cart WHERE user_id = ? AND item_id = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function post_add_sell_cart($dbh,$userid,$id,$now_date){
    try{
        $sql = 'INSERT sell_cart(user_id,item_id,how_many,create_date,update_date) VALUES(?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->bindValue(3,'1',PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function post_sell_cart($dbh,$userid,$id,$count,$now_date){
    try{
        $sql = 'UPDATE sell_cart SET how_many = ?, update_date = ?  WHERE user_id = ? AND item_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$count,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$userid,PDO::PARAM_STR);
        $stmt->bindValue(4,$id,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function adding_sell_cart($dbh,$userid,$id,$now_date){
    if(count($userid) !== 0){
        $userdata = get_sell_cart_data($dbh,$userid,$id);
        if(count($userdata) === 0){
            post_add_sell_cart($dbh,$userid,$id,$now_date);
            header('Location:sell.php');
        }else {
            $count = $userdata[0]['how_many'] + 1;
            post_sell_cart($dbh,$userid,$id,$count,$now_date);
            header('Location:sell.php');
        }
        
    } else {
            set_error('不正なユーザーです');
    }
}
function get_have($dbh,$userid){
    try{
        $sql = 'SELECT have FROM users_coin WHERE user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_avg($dbh,$userid){
    try{
        $sql = 'SELECT avg(price) FROM bought GROUP BY item_id WHERE user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_sum($dbh,$userid){
    $data = get_avg_sum($dbh,$userid);
    $sum = 0;
    foreach($data as $key=>$value){
        $sum += $value['have'] * $value['avg(price)'];
    }
    return $sum;
}
function get_in_money($dbh,$userid){
    try{
        $sql = 'SELECT sum(money) FROM atm WHERE user_id = ? GROUP BY user_id ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    if(count($rows) !== 0){
        return $rows[0]['sum(money)'];
    }else {
        return 0;
    }
}