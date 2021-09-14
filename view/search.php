<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Open+Sans&display=swap" rel="stylesheet">
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/index.css">
    </head>
    <body class="bg-light">
        <header>
            <div class="container">
                <?php require_once '../view/template/header.php' ?>
            </div>
        </header>
        <main>
            <div class="container">
                <?php require_once '../view/template/success.php' ?>
                <?php require_once '../view/template/errors.php' ?>
                <h1>通貨一覧</h1>
            </div>
            <div class="container">
                <div class="coins">
                    <?php if(count($data) !== 0){?>
                        <?php foreach($data as $key => $value){?>
                           <?php if($value['status'] == 1){?>
                           <div class="container coin" >
                               <div class="row justify-content-center">
                                        <div class="col-md-3  img-hidden">
                                          <img src="asserts/img/<?php print $value['img'];?>" alt="img" class="img-fulied coin_img">
                                        </div>
                                        <div class="col-md-7">
                                          <h2><?php print $value['name'];?></h2>
                                          <h3><?php print $value['price'];?>円</h3>
                                          <p><?php print $value['exp'];?></p>
                                          <div class="form-inline info">
                                              <form method = "post">
                                                    <?php if($value['stock'] === 0){ ?>
                                                            <p>売り切れ</p>
                                                    <?php }else{ ?>
                                                            <input  class="btn btn-primary btn-lg btn-block" type="submit" name="cart" value="カートに追加">
                                                            <input type="hidden" name="buy_id" value="<?php print $value['id'];?>">
                                                    <?php } ?>
                                                </form>
                                                <form method="get" action="../controller/show.php" style="margin-top:5px">
                                                    <input class="btn btn-primary btn-lg btn-block mybtn " type="submit" name="show" value="詳細">
                                                    <input type="hidden" name="show_id" value="<?php print $value['id']?>">
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                           <?php }?>
                       <?php }?>
                <?php }else{ ?>
                    <h2 class="bg-light"style="text-align:center;height:500px">検索結果のコインは０件です</h2>
                <?php } ?>
                </div>
            </div>
                
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>