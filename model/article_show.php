<?php
function get_count($dbh,$id){
    try{
        $sql = 'SELECT * from blog WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function count_article($dbh,$id){
    $count_data = get_count($dbh,$id);
    $count = $count_data[0]['count'] + 1;
    try{
        $sql = 'UPDATE blog SET count = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$count,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function throw_review($id,$userid,$now_date,$comment,$dbh){
    try{
        $sql = 'INSERT blog_review(user_id,blog_id,text,create_date,update_date) VALUES(?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->bindValue(3,$comment,PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
        $stmt->execute();
        set_success('レビューを投稿しました');
    }catch(PDOException $e){
        throw $e;
    }
}
function get_show_article($dbh,$id){
    try{
        $sql = 'SELECT blog.id,blog.title,blog.count,blog.update_date,users.username,blog.article from blog INNER JOIN users
                ON blog.user_id = users.id WHERE blog.id = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
function get_show_review($dbh,$id){
     try{
        $sql = 'SELECT blog_review.id,users.username,blog_review.text,blog_review.create_date,users.sex 
        from blog_review INNER JOIN users ON users.id = blog_review.user_id WHERE blog_review.blog_id = ? ORDER BY blog_review.create_date desc LIMIT 5';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}