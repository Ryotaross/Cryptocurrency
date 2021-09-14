<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Train+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Open+Sans&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/top.css">
    </head>
    <body>
        <header>
            <?php require_once '../view/template/header.php' ?>
        </header>
        <main>
            <section class="hero">
                <div class="contents">
                   <h1 class="title">CoinShop</h1>
                   <p>Welcome to World of New Coin!<br>
                       円でもドルでもない新しい通貨をあなたに</p>
                </div>
            </section>
            <section class="rank">
                <div container>
                    <div class="contents">
                        <h2 class="title">Ranking</h5>
                        <table class="rank_list">
                            <tr>
                                <th>１位：<?php print $top[0]['name'];?></th>
                                <td><?php print $top[0]['price'];?>円</td>
                            </tr>
                            <tr>
                                <th>２位：<?php print $top[1]['name'];?></th>
                                <td><?php print $top[1]['price'];?>円</td>
                            </tr>
                            <tr>
                                <th>３位：<?php print $top[2]['name'];?></th>
                                <td><?php print $top[2]['price'];?>円</td>
                            </tr>
                        </table>
                        <a class="btn btn-primary" href="index.php">その他はこちら</a>
                    </div>
                </div>
            </section>
            <section class="index">
                <div class="container">
                    <div class="contents">
                        <h2 class="title">Buy Now!</h2>
                        <table class="rank_list">
                            <?php foreach($data as $key=>$value){?>
                                <tr>
                                    <th><?php print $value['name'];?></th>
                                </tr>
                            <?php } ?>
                            <?php if(count($data) >= 10){?>
                                <tr>
                                    <th>And more...</th>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>