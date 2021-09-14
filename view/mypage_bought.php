<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Open+Sans&display=swap" rel="stylesheet">

        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/index.css">
        <link rel="stylesheet" href="asserts/css/mypage.css">
    </head>
    <body class="bg-light">
        <header>
            <div class="container">
               <?php require_once '../view/template/header.php' ?>
            </div>
        </header>
        <main class="main bg-light text-secondary">
            <div class="container">
                <?php require_once '../view/template/success.php' ?>
            </div>
            <div class="container coins main-contets">
                    <div class="contents">
                        <h2 class="title text-danger"><?php print $username;?></h5>
                        <table class="rank_list">
                            <tr>
                                <th>総資産</th>
                                <td><?php print $mydata_sum + $total_money;?>円</td>
                                 <?php if($compare > 0){?>
                                    <td class="text-primary">+<?php print $compare;?></td>
                                <?php }else if($compare < 0){ ?>
                                    <td class="text-danger"><?php print $compare;?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <th>仮想通貨</th>
                                <td><?php print $mydata_sum;?>円</td>
                            </tr>
                            <tr>
                                <th>現金残高</th>
                                <?php if($total_money > 0){?>
                                    <td><?php print $total_money;?>円</td>
                                    <td><a class="btn btn-primary" href="money.php">入金</a></td>
                                <?php }else { ?>
                                    <td>0円</td>
                                    <td><a class="btn btn-primary" href="money.php">入金</a></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="container coins sub-contents">
                    <div class="info">
                        <h2><a href="mypage.php">保有コイン</a></h2>
                        <h2 class="text-dark select">購入履歴</h2>
                        <h2 class="select"><a href="mypage_sold.php">売却履歴</a></h2>
                    </div>
                <?php if(count($data) !== 0){?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">購入日時</th>
                          <th scope="col">購入商品</th>
                          <th scope="col">購入数</th>
                          <th scope="col">購入価格</th>
                          <th scope="col">合計価格</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach($data as $key => $value){?>
                        <tr>
                          <th scope="row"><?php print $value['bought_date'];?></th>
                          <td><?php print $value['name'];?></td>
                          <td><?php print $value['how_many'];?></td>
                          <td><?php print $value['price'];?></td>
                          <td><?php print $value['how_many'] * $value['price'];?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                <?php }else { ?>
                    <div style="text-align:center;margin:auto 0;">
                        <h1 style="margin-top:100px;margin-bottom:30px">購入履歴はございません</h1>
                        <p><a class="btn btn-primary btn-lg btn-block" href="index.php" style="margin-bottom:170px">商品を追加する</a></p>
                    </div>
                <?php } ?>
            </div>   
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>