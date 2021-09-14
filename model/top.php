<?php
function get_top_item($dbh){
    try{
        $sql = 'select name,price from items order by id asc LIMIT 10';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_top_ariticle($dbh){
    
}
function get_top_data($dbh){
    try{
        $sql = 'select sum(bought.how_many),items.name,items.price from items  INNER JOIN bought ON items.id = bought.item_id 
                GROUP BY bought.item_id order by sum(bought.how_many) desc LIMIT 3';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
