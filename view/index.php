<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,, shrink-to-fit=no">
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
        <main class="main bg-light text-secondary">
            <div class="container" >
                <?php require_once '../view/template/success_cart.php' ?>
                <?php require_once '../view/template/errors.php' ?>
            </div>
            <div class="container">
                <div class="coins">
                    <div class="row justify-content-end">
                    <form method="post" class="col-md-3 info">
                        <select class="form-select" aria-label="Default select example" name="row_change">
                             <option selected>並び替え</option>
                             <option value="rank">人気順</option>
                             <option value="price">価格順</option>
                        </select>
                        <input type="submit" class="btn btn-info" name="row" value="表示">
                    </form>
                    </div>
                    <?php foreach($data as $key => $value){?>
                       <?php if($value['status'] == 1){?>
                           <div class="container coin" >
                               <div class="row justify-content-center">
                                        <div class="col-3  img-hidden">
                                          <img src="asserts/img/<?php print $value['img'];?>" alt="img" class="img-fulied coin_img">
                                        </div>
                                        <div class="col-7">
                                          <h2 class="text-dark"><?php print $value['name'];?></h2>
                                          <h3>現在値：<?php print $value['price'];?>円</h3>
                                          <p><?php print $value['exp'];?></p>
                                          <div class="form-inline info">
                                              <form method = "post">
                                                    <?php if($value['stock'] === 0){ ?>
                                                            <p class="text-danger">売り切れ</p>
                                                    <?php }elseif(!isset($username)){ ?>
                                                        <a class="btn btn-primary btn-lg btn-block" href="login.php">カートに追加</a>
                                                    <?php }else{ ?>
                                                            <input class="btn btn-primary btn-lg btn-block" type="submit" name="cart" value="カートに追加">
                                                            <input type="hidden" name="buy_id" value="<?php print $value['id'];?>">
                                                    <?php } ?>
                                                </form>
                                                <!--
                                                <form method="get" action="../controller/show.php" style="margin-top:5px">
                                                    <input class="btn btn-primary btn-lg btn-block mybtn " type="submit" name="show" value="詳細">
                                                    <input type="hidden" name="show_id" value="<?php print $value['id']?>">
                                                </form>
                                                -->
                                            </div>
                                        </div>
                                </div>
                            </div>
                       <?php }?>
                   <?php }?>
                </div>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>