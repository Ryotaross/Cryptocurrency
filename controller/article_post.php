<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/article_post.php';

$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();


try{
    $dbh = get_db_connect();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(is_POST('submit')){
            $title = get_post_data('title');
            $article = get_post_data('article');
            $userid = get_user_id($dbh,$username);
            word_check($title,'タイトル');
            word_check($article,'記事');
            if(count($_SESSION['error']) === 0){
                post_article($dbh,$title,$article,$userid,$now_date);
            }
        }
    }
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}
include_once '../view/article_post.php';