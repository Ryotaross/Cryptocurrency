<?php
function get_items($dbh,$letter){
    try{
        $letter = '%'.$letter.'%';
        $sql = 'SELECT id,name,price,img,exp,stock,status from items WHERE name LIKE ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$letter,PDO::PARAM_STR); 
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
    
}

