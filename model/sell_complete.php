<?php
function get_sell_cart($dbh,$userid){
    try{
        $sql = 'SELECT sell_cart.item_id,items.name,items.img,items.price,items.stock,sell_cart.how_many,items.stock,items.status,users_coin.have 
                FROM items INNER JOIN sell_cart ON items.id = sell_cart.item_id 
                INNER JOIN users_coin ON sell_cart.item_id = users_coin.item_id 
                WHERE sell_cart.user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function sell_check($data){
    if(count($data) === 0){
        set_error('カートの中身がありません');
    }
    foreach($data as $key => $value){
        if($value['how_many'] > $value['have']){
            set_error('所持コイン数を超えています');
        }
        if($value['status'] === 0){
            set_error('非公開の商品が含まれています');
        }
    }
}
function delete_users_coin($dbh,$userid,$item_id){
     try{
        $sql = 'DELETE FROM users_coin WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$item_id,PDO::PARAM_STR);
        $stmt->bindValue(2,$userid,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
            throw $e;
    }
}
function change_users_coin($dbh,$userid,$count,$item_id,$now_date){
    try{
        $sql = 'UPDATE users_coin SET have = ?,update_date = ? WHERE item_id = ? AND user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$count,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$item_id,PDO::PARAM_STR);
        $stmt->bindValue(4,$userid,PDO::PARAM_STR);
        $stmt->execute();
        }catch(PDOException $e){
            throw $e;
        }
}
function update_users_coin($dbh,$userid,$data,$now_date){
    if(count($userid !== 0)){
        foreach($data as $key => $value){
            $item_id = $value['item_id'];
            $sell_count = $value['how_many'];
            $have_count = $value['have'];
            $count = $have_count - $sell_count;
            if($count === 0){
                delete_users_coin($dbh,$userid,$item_id);
            }else if ($count > 0){
                change_users_coin($dbh,$userid,$count,$item_id,$now_date);
            }else{
                set_error('不正な取引です');
            }
        }
    }
}
function sell_complete($dbh,$data,$now_date){
    foreach($data as $key => $value){
        $stock = $value['stock'] + $value['how_many'];
        $item_id = $value['item_id'];
        try{
        $sql = 'UPDATE items SET stock = ?,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$stock,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$item_id,PDO::PARAM_STR);
        $stmt->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }
    
}
function delete_complete($userid,$dbh,$data){
    foreach($data as $key => $value){
        $item_id = $value['item_id'];
        try{
            $sql = 'DELETE FROM sell_cart WHERE item_id = ? AND user_id = ?';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1,$item_id,PDO::PARAM_STR);
            $stmt->bindValue(2,$userid,PDO::PARAM_STR);
            $stmt->execute();
        }catch(PDOException $e){
            throw $e;
    }
    }
}
function write_sell_data($userid,$dbh,$data,$now_date){
    foreach($data as $key => $value){
        $item_id = $value['item_id'];
        $how_many = $value['how_many'];
        $price = $value['price'];
        try{
            $sql = 'INSERT sold(item_id,user_id,how_many,price,create_time) VALUES(?,?,?,?,?)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1,$item_id,PDO::PARAM_STR);
            $stmt->bindValue(2,$userid,PDO::PARAM_STR);
            $stmt->bindValue(3,$how_many,PDO::PARAM_STR);
            $stmt->bindValue(4,$price,PDO::PARAM_STR);
            $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
            $stmt->execute();
        }catch(PDOException $e){
            throw $e;
        }
    }
}
function selling($dbh,$data,$userid,$now_date){
    try{
        sell_complete($dbh,$data,$now_date);
        delete_complete($userid,$dbh,$data);
        write_sell_data($userid,$dbh,$data,$now_date);
        set_success('売却が完了しました<br>売却ありがとうございます！');
    }catch(PDOException $e){
        $err_msg = $e->getMessage();
    }
}
function update_users_money($dbh,$sum,$userid,$now_date,$total_money){
    $total_money = $total_money + $sum;
    try{
        $sql = 'UPDATE users SET money = ?,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$total_money,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$userid,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}