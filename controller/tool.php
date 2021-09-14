<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/tool.php';
require_once '../model/rate.php';

$data = array();
$img_dir = 'asserts/img/';
$new_img_file = '';
$now_date = date('Y-m-d H:i:s');

session_start();
session_tool_check();

try{
    $dbh = get_db_connect();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = get_post_data('name');
        $price = get_post_data('price');
        $quantity = get_post_data('quantity');
        $explain = get_post_data('explain');
        $status = get_post_data('status');
        if(is_POST('submit')){
            input_check($name,$price,$quantity,$explain);
            $new_img_file = img_check($new_img_file,$img_dir);
            if(count($_SESSION['error']) === 0){
                post_data($dbh,$new_img_file,$name,$price,$status,$quantity,$explain,$now_date);
            }
            //在庫数
        }else if(is_POST('change')) {
            $stock = get_post_data('change');
            $id = get_post_data('change_id');
            number_check($stock,'在庫');
            if(count($_SESSION['error']) === 0){
                change_stock($dbh,$stock,$now_date,$id);
            }
            //ステータス
        }else if(is_POST('status_show')){
            $id = get_post_data('status_id');
            change_status_show($dbh,$now_date,$id);
        }else if(is_POST('status_unshow')){
            $id = get_post_data('status_id');
            change_status_unshow($dbh,$now_date,$id);
        }else if(is_POST('change_exp')) {
            $explain = get_post_data('change_exp');
            $id = get_post_data('change_id');
            word_check($explain,'説明文');
            if(count($_SESSION['error']) === 0){
                change_explain($dbh,$explain,$now_date,$id);
            }
        }else if(is_POST('delete')) {
            $img = get_post_data('change_img');
            $id = get_post_data('change_id');
            if(count($_SESSION['error']) === 0){
                delete_data($dbh,$id,$img);
            }
        }else if(is_POST('logout')) {
            logout_method();
        }
    }
    now_rate($dbh,$now_date);
    $data = get_to_manage_data($dbh);
}catch(PDOException $e){
    $err_msg[] = $e->getMessage();
}
include_once '../view/tool.php';