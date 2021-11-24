<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/article_index.php';


try{
    $dbh = get_db_connect();
    $article = get_article($dbh);
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}
include_once '../view/article_index.php';