<?php
function get_items($dbh){
    try{
        $sql = 'SELECT id,name,price,img,exp,stock,status from items';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
    
}
function get_top_data($dbh){
    try{
        $sql = 'select items.id,items.name,items.price,items.img,items.exp,items.stock,items.status from items  INNER JOIN bought ON items.id = bought.item_id 
                GROUP BY bought.item_id order by sum(bought.how_many) desc';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_high_data($dbh){
    try{
        $sql = 'SELECT id,name,price,img,exp,stock,status from items order by price desc';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}

function row_change($dbh,$row_change){
    if($row_change === "rank"){
        $data = get_top_data($dbh);
    }else if ($row_change === "price"){
        $data = get_high_data($dbh);
    }else{
        $data = get_items($dbh);
    }
    return $data;
}

