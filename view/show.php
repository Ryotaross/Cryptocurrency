<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Open+Sans&display=swap" rel="stylesheet">
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/show.css">
        <link rel="stylesheet" href="asserts/css/index.css">
    </head>
    <body class="bg-light text-secondary">
        <header>
            <div class="container">
                <?php require_once '../view/template/header.php' ?>
            </div>
        </header>
        <main main="main">
            <div class="container">
                <?php require_once '../view/template/success_cart.php' ?>
                <?php require_once '../view/template/errors.php' ?>
            </div>
            <div class="container coins">
               <div class="container coin">
                    <div class="row justify-content-center">
                    <?php if($data[0]['status'] == 1){?>
                        <h2 class="text-dark"><?php print $data[0]['name'];?></h2>
                        <div class="col-md-3  img-hidden">
                            <img src="asserts/img/<?php print $data[0]['img'];?>" alt="img" class="img-fulied coin_img">
                        </div>
                        <div class="col-md-7">
                            <p class="font-weight-bold text-dark">現在値：<?php print $data[0]['price'];?>円</hp>
                            <p><?php print $data[0]['exp'];?></p>
                            <div class="form-inline">
                                <form method = "post">
                                    <?php if($data[0]['stock'] === 0){ ?>
                                        <p>売り切れ</p>
                                    <?php }else{ ?>
                                        <input  class="btn btn-primary btn-lg btn-block" type="submit" name="cart" value="カートに追加">
                                        <input type="hidden" name="buy_id" value="<?php print $data[0]['id'];?>">
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="review">
                        <h2>レビュー</h2>
                        <?php foreach ($review as $key => $value){ ?>
                        <div class="row justify-content-center">
                            <div class="card w-75 col-md-8">
                              <div class="card-body">
                                <h5 class="card-title"><?php print $value['text'];?></h5>
                                <p class="card-text"><?php print $value['username'];?> <?php print $value['create_date'];?></p>
                              </div>
                            </div>
                        </div>
                        <?php } ?>
                        <form class="form-inline" method="post" style="margin-top:50px">
                            <h2>レビューを書く</h2>
                            <div class="row justify-content-center">
                                <div class="form-group mx-sm-3 mb-2 col-md-8">
                                    <div class="info">
                                        <textarea name="comment" class="form-control" id="inputPassword2"></textarea>
                                        <input class="tweet btn btn-primary mb-2 tweet"type="submit" name="throw" value="送信">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } else {?>
                   <h2>ただいま取り扱っておりません</h2>
                <?php } ?>
                </div>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>