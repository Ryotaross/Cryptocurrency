<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/admin.php';

$now_date = date('Y-m-d H:i:s');
$err_msg = array();
$data =array();

session_start();
session_tool_check();
if(is_POST('logout')) {
    logout_method();
}
try{
    $dbh = get_db_connect();
    $data = get_user($dbh); 
}catch(PDOException $e){
    throw $e;
}
include_once '../view/admin.php';