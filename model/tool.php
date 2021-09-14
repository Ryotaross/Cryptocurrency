<?php
require_once '../model/coinshop.php';
function input_check($name,$price,$quantity,$explain){
    word_check($name,'名前');
    number_check($price,'価格');
    number_check($quantity,'個数');
    word_check($explain,'説明文');
}
function img_check($new_img_file,$img_dir){
     if(is_uploaded_file($_FILES['photo']['tmp_name']) === TRUE){
            //拡張子を取得
            $extension = pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION);
            //指定の拡張子かチェック
            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'JPG' || $extension === 'JPEG' || $extension === 'PNG'){
                //保存するファイル名の生成s
                $new_img_file = sha1(uniqid(mt_rand(),true)).'.' .$extension;
                //同名のファイルが有るか確認
                if(is_file($img_dir . $new_img_file) !== TRUE){
                    //アップロードされたファイルを指定ディレクトリに保存
                    if(move_uploaded_file($_FILES['photo']['tmp_name'],$img_dir . $new_img_file) !== TRUE){
                        set_error('ファイルアップロードに失敗しました');
                    }
                } else {
                    set_error('ファイルアップロードに失敗しました。再度お試しください');
                }
            }else{
                set_error('ファイル形式が異なります。');
            }
        } else{
            set_error('ファイルを選択してください');
        }
        return $new_img_file;
}
function post_data($dbh,$new_img_file,$name,$price,$status,$quantity,$explain,$now_date){
    
    $dbh->beginTransaction();
    try{
        post_to_items($dbh,$new_img_file,$name,$price,$status,$quantity,$explain,$now_date);
        set_success('追加完了!');
        $dbh->commit();
    }catch(PDOException $e){
        $dbh->rollback();
        $err_msg[] = $e->getMessage();
    }
}
function post_to_items($dbh,$new_img_file,$name,$price,$status,$quantity,$explain,$now_date){
    try{
        $sql = 'INSERT INTO items(img,name,price,status,exp,create_date,update_date,stock) VALUES(?,?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$new_img_file,PDO::PARAM_STR);
        $stmt->bindValue(2,$name,PDO::PARAM_STR);
        $stmt->bindValue(3,$price,PDO::PARAM_STR);
        $stmt->bindValue(4,$status,PDO::PARAM_STR);
        $stmt->bindValue(5,$explain,PDO::PARAM_STR);
        $stmt->bindValue(6,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(7,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(8,$quantity,PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function change_stock_check($num,$name){
    if($num ===''){
        set_error($name.'を入力してください');
    }else if($num < 0){
        set_error($name.'は０以上の整数を入力してください');
    }else if(preg_match('/^[0-9]+$/',$num)!==1){
        set_error($name.'は数字を入力してください');
    }
}
function change_stock($dbh,$stock,$now_date,$id){
    try{
        $sql = 'UPDATE items SET stock = ?,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$stock,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_STR);
        $stmt->execute();
        set_success('変更完了!');
    }catch(PDOException $e){
        throw $e;
    }
}
function change_status_show($dbh,$now_date,$id){
    try{
        $sql = 'UPDATE items SET status = 0,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->execute();
        set_success('変更完了!');
    }catch(PDOException $e){
        throw $e;
    }
}
function change_status_unshow($dbh,$now_date,$id){
    try{
        $sql = 'UPDATE items SET status = 1,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(2,$id,PDO::PARAM_STR);
        $stmt->execute();
        set_success('変更完了!');
    }catch(PDOException $e){
        throw $e;
    }
}
function change_exp_check($err_msg,$explain){
if(empty($explain)){
        $err_msg[] = '説明文を入力してください';
    }
    return $err_msg;
}
function change_explain($dbh,$explain,$now_date,$id){
    try{
        $sql = 'UPDATE items SET exp = ?,update_date = ? WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$explain,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$id,PDO::PARAM_STR);
        $stmt->execute();
        set_success('変更完了!');
    }catch(PDOException $e){
        throw $e;
    }
}
function delete_data($dbh,$id,$img){
    try{
        $sql = 'DELETE FROM items WHERE id = ? AND img = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$id,PDO::PARAM_STR);
        $stmt->bindValue(2,$img,PDO::PARAM_STR);
        $stmt->execute();
        set_success('削除完了!');
    }catch(PDOException $e){
        throw $e;
    }
}
function get_to_manage_data($dbh){
    try{
        $sql = 'select img,name,price,stock,status,exp,id
                from items';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
    return $rows;
}
