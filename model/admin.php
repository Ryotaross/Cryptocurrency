<?php
function get_user($dbh){
    try{
        $sql = 'select username,create_date from users';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}