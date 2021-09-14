<?php
function get_article($dbh){
    try{
        $sql = 'SELECT blog.id,blog.title,blog.count,blog.update_date,users.username from blog INNER JOIN users
                ON blog.user_id = users.id ORDER BY blog.create_date desc';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
    
}

