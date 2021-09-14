<?php
$json_str = @file_get_contents("https://api.bitflyer.jp/v1/ticker?product_code=BTC_JPY");
$json_btc = json_decode($json_str);
//var_dump($json_btc);

$json_str = @file_get_contents("https://api.bitflyer.jp/v1/ticker?product_code=ETH_JPY");
$json_eth = json_decode($json_str);
//var_dump($json_eth);

$btc = number_format($json_btc->ltp);
$eth = number_format($json_eth->ltp);

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
function now_rate($dbh,$now_date){
    $json_str = @file_get_contents("https://api.bitflyer.jp/v1/ticker?product_code=BTC_JPY");
    $json_btc = json_decode($json_str);
    $btc = $json_btc->ltp;
    
    $json_str = @file_get_contents("https://api.bitflyer.jp/v1/ticker?product_code=ETH_JPY");
    $json_eth = json_decode($json_str);
    $eth = $json_eth->ltp;
    now_rate_btc($dbh,$now_date,$btc);
    now_rate_eth($dbh,$now_date,$eth);
}

