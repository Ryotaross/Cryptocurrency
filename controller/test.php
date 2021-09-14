<?php
    //必要なモデルや設定ファイルを読み込む
    
    //セッション開始
    session_start();
    //DB接続する
    //$dbh = get_db_connect();
    
    //POSTでリクエストされた場合の処理
    if(is_POST() === true){
        number_check($_POST['price'],'価格');
    /*
        //新規登録処理
        put_new_product();
        //在庫アップデート処理
        change_stock();
        //ステータス変更処理
        change_status();
        //削除処理
        delete_product();
        */
    }
    //POSTだろうがGETだろうが商品一覧は取得する
    //$data = get_all_product();

    //$id = $_GET['id'];
    //$sql = 'select * from detail_data where id=?'


    ///////本来モデルに書く内容///////
    function is_POST(){
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    function number_check($num,$name){
        if(mb_strlen(trim($num))===0){
            set_error($name.'を入力してください');
        }else if(preg_match('/^[0-9]+$/',$num)!==1){
            set_error($name.'は数字を入力してください');
        }
    }
    
    function set_error($message){
        $_SESSION['error'][] = $message;
    }

    include_once '../view/test.php';