<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Open+Sans&display=swap" rel="stylesheet">
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/index.css">
    </head>
    <body class="bg-light">
        <header>
            <div class="container">
                <?php require_once '../view/template/header.php' ?>
            </div>
        </header>
        <main class="main text-secondary">
            <div class="container">
                <?php require_once '../view/template/success_comp.php' ?>
                <?php require_once '../view/template/errors_sellcomp.php' ?>
                <h2>売却一覧</h2>
            </div>
            <?php if(count($_SESSION['error']) === 0){ ?>
                <?php if($sum > 0){ ?>
                    <div class="container coins">
                    <?php foreach($data as $key => $value){?>
                           <div class="container coin">
                               <div class="row justify-content-center">
                                    <div class="col-md-3  img-hidden">
                                      <img src="asserts/img/<?php print $value['img'];?>" alt="img" class="img-fulied coin_img" >
                                    </div>
                                    <div class="col-md-7">
                                      <h2 class="text-dark"><?php print $value['name'];?></h2>
                                      <div class="info">
                                          <h3><?php print $value['price'];?>円&emsp;</h3>
                                          <h4>✕&emsp;</h4>
                                          <h3><?php print $value['how_many'];?></h3>
                                      </div>
                                      <h3>合計：<?php print $value['price'] * $value['how_many'];?>円</h3>
                                    </div>
                                </div>
                            </div>
                   <?php }?>
                       <div class="sum">
                           <div class="container" style="text-align:center">
                               <h2 class="font-weight-bold text-dark">合計金額：<?php print $sum;?>円</h2>
                                <p><a class="btn btn-primary btn-lg btn-block" href="mypage.php">マイページへ</a></p>
                           </div>
                       </div>
                    </div>
                <?php }else{ ?>
                    <div class="container bg-light" style="text-align:center; margin-bottom:400px;">
                        <p><a class="btn btn-primary btn-lg btn-block" href="mypage.php">商品を追加する</a></p>
                    </div>
                <?php } ?>
            <?php } ?>
        </main>
       <?php require_once '../view/template/footer.php' ?>
    </body>
</html>