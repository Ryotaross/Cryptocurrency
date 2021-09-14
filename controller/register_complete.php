<?php
require_once '../conf/const.php';
require_once '../model/coinshop.php';
require_once '../model/register.php';

$now_date = date('Y-m-d H:i:s');
$err_msg = array();
$double = array();

session_start();
$_SESSION['error'] = [];


include_once '../view/register_complete.php';