<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <!--<link rel="stylesheet" href="../css/index.css">-->
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
        <main class="main bg-light text-secondary" >
            <div class="container" >
                <?php require_once '../view/template/success.php' ?>
                <?php require_once '../view/template/errors.php' ?>
                <h1>体験談一覧</h1>
            </div>
            <div class="coins">
                <?php foreach($article as $key => $value){?>
                       <div class="container coin">
                           <div class="row">
                               <div class="col-3  img-hidden">
                                  <img src="asserts/img/white.jpg" alt="img" class="img-fulied coin_img">
                                </div>
                                <div class="col-7">
                                  <h2 class="text-dark"><?php print $value['title'];?></h2>
                                  <h3><?php print $value['username'];?></h3>
                                  <p><?php print $value['update_date'];?></p>
                                    <form method="get" action="../controller/article_show.php" style="margin-top:5px">
                                        <input class="btn btn-primary btn-lg btn-block " type="submit" name="show" value="詳細">
                                        <input type="hidden" name="show_id" value="<?php print $value['id']?>">
                                    </form>
                                    </div>
                                </div>
                            </div>
               <?php }?>
               </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>