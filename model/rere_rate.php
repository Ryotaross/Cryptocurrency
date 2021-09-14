<?php
function now_rate($dbh,$now_date){
    //btc
    $json_str = @file_get_contents("https://public.bitbank.cc/btc_jpy/ticker");
    $json_btc = json_decode($json_str);
    $btc_array = (array)$json_btc;
    $btc = (array)$btc_array['data'];
    
    //eth
    $json_str = @file_get_contents("https://public.bitbank.cc/eth_jpy/ticker");
    $json_eth = json_decode($json_str);
    $eth_array = (array)$json_eth;
    $eth = (array)$eth_array['data'];
    
    //xrp
    $json_str = @file_get_contents("https://public.bitbank.cc/xrp_jpy/ticker");
    $json_xrp = json_decode($json_str);
    $xrp_array = (array)$json_xrp;
    $xrp = (array)$xrp_array['data'];
    
    //ltc
    $json_str = @file_get_contents("https://public.bitbank.cc/ltc_jpy/ticker");
    $json_ltc = json_decode($json_str);
    $ltc_array = (array)$json_ltc;
    $ltc = (array)$ltc_array['data'];
    
    //moma
    $json_str = @file_get_contents("https://public.bitbank.cc/moma_jpy/ticker");
    $json_moma = json_decode($json_str);
    $moma_array = (array)$json_moma;
    $moma = (array)$moma_array['data'];
    
    //bcc
    $json_str = @file_get_contents("https://public.bitbank.cc/bcc_jpy/ticker");
    $json_bcc = json_decode($json_str);
    $bcc_array = (array)$json_bcc;
    $bcc = (array)$bcc_array['data'];
    
    //xlm
    $json_str = @file_get_contents("https://public.bitbank.cc/xlm_jpy/ticker");
    $json_xlm = json_decode($json_str);
    $xlm_array = (array)$json_xlm;
    $xlm = (array)$xlm_array['data'];
    
    //gtum
    $json_str = @file_get_contents("https://public.bitbank.cc/qtum_jpy/ticker");
    $json_qtum = json_decode($json_str);
    $qtum_array = (array)$json_qtum;
    $qtum = (array)$qtum_array['data'];
    
    //bat
    $json_str = @file_get_contents("https://public.bitbank.cc/bat_jpy/ticker");
    $json_bat = json_decode($json_str);
    $bat_array = (array)$json_bat;
    $bat = (array)$bat_array['data'];
    
    $btc = number_format($btc['buy']);
    $eth = number_format($eth['buy']);
    $xrp = number_format($xrp['buy']);
    $ltc = number_format($ltc['buy']);
    $moma = number_format($moma['buy']);
    $bcc = number_format($bcc['buy']);
    $xlm = number_format($xlm['buy']);
    $qtum = number_format($qtum['buy']);
    $bat = number_format($bat['buy']);
    
    //DB更新
    now_rate_btc($dbh,$now_date,$btc);
    now_rate_eth($dbh,$now_date,$eth);
    now_rate_xrp($dbh,$now_date,$xrp);
    now_rate_ltc($dbh,$now_date,$ltc);
    now_rate_moma($dbh,$now_date,$moma);
    now_rate_bcc($dbh,$now_date,$bcc);
    now_rate_xlm($dbh,$now_date,$xlm);
    now_rate_qtum($dbh,$now_date,$qtum);
    now_rate_bat($dbh,$now_date,$bat);
    
}


function now_rate_btc($dbh,$now_date,$btc){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$btc,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'ビットコイン',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_eth($dbh,$now_date,$eth){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$eth,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'イーサリアム',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_xrp($dbh,$now_date,$xrp){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$xrp,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'リップル',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_ltc($dbh,$now_date,$ltc){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$ltc,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'ライトコイン',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_moma($dbh,$now_date,$moma){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$moma,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'モナコイン',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_bcc($dbh,$now_date,$bcc){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$bcc,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'ビットコインクラシック',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_xlm($dbh,$now_date,$xlm){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$xlm,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'ステラルーメン',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_qtum($dbh,$now_date,$qtum){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$qtum,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'クアンタム',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
function now_rate_bat($dbh,$now_date,$bat){
    try{
        $sql = 'UPDATE items SET price = ?,update_date = ? WHERE name = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$bat,PDO::PARAM_STR);
        $stmt->bindValue(2,$now_date,PDO::PARAM_STR);
        $stmt->bindValue(3,'ベーシックアテンショントークン',PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        throw $e;
    }
}
