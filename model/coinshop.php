<?php
function get_db_connect(){
    try{
        $dbh = new PDO(DSN,DB_USER,DB_PASSWD,array(PDO::MYSQL_ATTR_INIT_COMMAND => DB_CHARSET));
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }catch(PDOException $e){
        throw $e;
    }
    return $dbh;
}
function session_tool_check(){
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] !== 'admin'){
            header('Location:login.php');
            exit;
    }
    }else{
        header('Location:login.php');
        exit;
    }
}
function session_check(){
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
        exit;
    } else {
    $username = $_SESSION['username'];
}
}

function get_username(){
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    return $username;
}
function logout_method(){
    session_start();
    $session_name = session_name();
    $_SESSION = array();
    
    if(isset($_COOKIE[$_session_name])){
        $params = session_get_cookie_params();
        
        setcookie($session_name,'',time() -42000,
        $params["path"],$params["domain"],$params["secure"],$params["httponly"]);
    }
    
    session_destroy();
    header('Location:/top.php');
    exit;
}
function get_post_data($key){
    $str = '';
    if(isset($_POST[$key])){
        $str = htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8');
    }
    return $str;
}
function get_post_number($key){
    $str = '';
    if(isset($_POST[$key])){
        $str = $_POST[$key];
    }
    return $str;
}

function is_POST($key){
    return isset($_POST[$key]);
}
function number_check($num,$name){
    if(mb_strlen(trim($num))===0){
        set_error($name.'を入力してください');
    }else if(preg_match('/^[0-9]+$/',$num)!==1){
        set_error($name.'は数字を入力してください');
    }else if($num < 0){
        set_error($name.'は０以上の整数を入力してください');
    }
}
function word_check($word,$name){
    if(empty($word)){
        set_error($name.'を入力してください');
    }
}
function set_error($message){
    $_SESSION['error'][] = $message;
}
function set_success($message){
    $_SESSION['success'][] = $message;
}
function get_user_id($dbh,$username){
    try{
        $sql = 'SELECT id from users WHERE username = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$username,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows[0]['id'];
}
function get_cart_sum($data){
    $sum = 0;
    foreach($data as $key => $value){
        $item_sum = $value['price'] * $value['how_many'];
        $sum += $item_sum;
    }
    return $sum;
}
function get_cart_data($dbh,$userid,$id){
    try{
        $sql = 'SELECT how_many from carts WHERE user_id = ? AND item_id = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}

function post_add_cart($dbh,$userid,$id,$now_date){
    try{
        $sql = 'INSERT carts(user_id,item_id,how_many,create_date,update_date) VALUES(?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->bindValue(3,'1',PDO::PARAM_STR);
        $stmt->bindValue(4,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(5,$now_date,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function post_cart($dbh,$userid,$id,$count,$now_date){
    try{
        $sql = 'UPDATE carts SET how_many = ?, update_date = ?  WHERE user_id = ? AND item_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$count,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$userid,PDO::PARAM_STR);
        $stmt->bindValue(4,$id,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function adding_cart($dbh,$userid,$id,$now_date){
    if(count($userid) !== 0){
        $userdata = get_cart_data($dbh,$userid,$id);
        if(count($userdata) === 0){
            post_add_cart($dbh,$userid,$id,$now_date);
            set_success('カートに追加しました');
        }else {
            $count = $userdata[0]['how_many'] + 1;
            post_cart($dbh,$userid,$id,$count,$now_date);
            set_success('カートに追加しました');
        }
    } else {
            set_error('不正なユーザーです');
    }
}
function get_total_money($dbh,$userid){
    try{
        $sql = 'SELECT money FROM users WHERE id = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$userid,PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows[0]['money'];
}