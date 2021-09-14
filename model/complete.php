<?php

function get_cart($dbh,$userid){
    try{
        $sql = 'SELECT carts.item_id,items.name,items.img,items.price,items.stock,carts.how_many,items.stock,items.status FROM items
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
function buy_check($data,$sum,$total_money){
    if(count($data) === 0){
        set_error('カートの中身がありません');
    }
    if($sum > $total_money){
        set_error('金額が足りません');
    }
    foreach($data as $key => $value){
        if($value['stock'] < $value['how_many']){
            set_error('在庫がありません');
        }
        if($value['status'] === 0){
            set_error('非公開の商品が含まれています');
        }
    }
}
function buy_complete($dbh,$data,$now_date){
    foreach($data as $key => $value){
        $stock = $value['stock'] - $value['how_many'];
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
            $sql = 'DELETE FROM carts WHERE item_id = ? AND user_id = ?';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1,$item_id,PDO::PARAM_STR);
            $stmt->bindValue(2,$userid,PDO::PARAM_STR);
            $stmt->execute();
        }catch(PDOException $e){
            throw $e;
    }
    }
}
function write_buy_data($userid,$dbh,$data,$now_date){
    foreach($data as $key => $value){
        $item_id = $value['item_id'];
        $how_many = $value['how_many'];
        $price = $value['price'];
        try{
            $sql = 'INSERT bought(item_id,user_id,how_many,price,bought_date) VALUES(?,?,?,?,?)';
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
function buying($dbh,$data,$userid,$now_date){
    try{
        buy_complete($dbh,$data,$now_date);
        delete_complete($userid,$dbh,$data);
        write_buy_data($userid,$dbh,$data,$now_date);
        set_success('購入が完了しました<br>お買い上げありがとうございます！');
    }catch(PDOException $e){
        $err_msg = $e->getMessage();
    }
}
function update_users_money($dbh,$sum,$userid,$now_date,$total_money){
    $total_money = $total_money - $sum;
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
function get_users_coin_data($dbh,$userid,$item_id){
    try{
        $sql = 'SELECT have from users_coin WHERE user_id = ? AND item_id = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$item_id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function first_users_coin($dbh,$userid,$item_id,$how_many,$now_date){
    try{
        $sql = 'INSERT users_coin(user_id,item_id,have,update_date) VALUES(?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$item_id,PDO::PARAM_STR);
        $stmt->bindValue(3,$how_many,PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function add_users_coin($dbh,$userid,$item_id,$count,$now_date){
    try{
        $sql = 'UPDATE users_coin SET have = ?, update_date = ?  WHERE user_id = ? AND item_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$count,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$userid,PDO::PARAM_STR);
        $stmt->bindValue(4,$item_id,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function update_users_coin($dbh,$userid,$data,$now_date){
    if(count($userid !== 0)){
         foreach($data as $key=>$value){
            $item_id = $value['item_id'];
            $how_many = $value['how_many'];
            $userdata = get_users_coin_data($dbh,$userid,$item_id);
            if(count($userdata) === 0){
                first_users_coin($dbh,$userid,$item_id,$how_many,$now_date);
            }else {
                $count = $userdata[0]['have'] + $how_many;
                add_users_coin($dbh,$userid,$item_id,$count,$now_date);
            }
        }
    }else{
        set_error('不正なユーザーです');
    }
}