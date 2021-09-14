<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Open+Sans&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width">
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
            <div class="container">
                <?php require_once '../view/template/success.php' ?>
                <?php require_once '../view/template/errors.php' ?>
                <h2>カート一覧</h2>
            </div>
            <div class="container">
                <?php if($sum > 0){ ?>
                <div class="coins">
                    <?php foreach($data as $key => $value){?>
                       <div class="container coin">
                           <div class="row justify-content-center">
                                <div class="col-3  img-hidden">
                                  <img src="asserts/img/<?php print $value['img'];?>" alt="img" class="img-fulied coin_img">
                                </div>
                                <div class="col-7">
                                  <h2 class="text-dark m16" ><?php print $value['name'];?></h2>
                                  <h3 class="m16">現在値：<?php print $value['price'];?>円</h3>
                                                                 
                                  <form class="form-inline info" method="post">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="text" name="quentity" value="<?php print $value['how_many'];?>" class="form-control" id="inputPassword2" style="width:100px;">
                                        <input type="hidden" name="change_id" value="<?php print $value['item_id'];?>">
                                    </div>
                                      <input class="btn btn-primary mb-2"type="submit" name="change" value="変更する">
                                    </form>
                                    <form method="post" class="form-inline">
                                        <input class="btn btn-danger mb-2 delete_btn" type="submit" name="delete" value="削除する">
                                         <input type="hidden" name="delete_id" value="<?php print $value['item_id'];?>">
                                    </form>
                                
                                </div>
                            </div>
                        </div>
                   <?php }?>
                   <div class="sum">
                       <div class="container" style="text-align:center">
                           <h2 class="font-weight-bold">合計金額：<?php print $sum;?>円</h2>
                            <p><a class="btn btn-primary btn-lg btn-block" href="complete.php">購入する</a></p>
                       </div>
                   </div>
                   </div>
               <?php }else{ ?>
                   <div class="container bg-light" style="text-align:center; margin-bottom:400px">
                           <h2 class="font-weight-bold text-dark">カートには何も入っていません</h2>
                            <p><a class="btn btn-primary btn-lg btn-block" href="index.php">商品を追加する</a></p>
                    </div>
                <?php } ?>
                
            </div>
                
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>