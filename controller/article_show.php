<?php 
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/article_show.php';

$id = $_GET['show_id'];
$now_date = date('Y-m-d H:i:s');

session_start();
session_check();
$username = get_username();
$_SESSION['error'] = [];

try{
    $dbh = get_db_connect();
    $userid = get_user_id($dbh,$username);
    count_article($dbh,$id);
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(is_POST('throw')){
            $comment = get_post_data('comment');
            word_check($comment,'レビュー');
            if(count($_SESSION['error']) === 0){
                throw_review($id,$userid,$now_date,$comment,$dbh);
            }
        }
    }
    $data = get_show_article($dbh,$id);
    $review = get_show_review($dbh,$id);
}catch(PDOException $e){
    $err_msg = $e->getMessage();
}
include_once '../view/article_show.php';