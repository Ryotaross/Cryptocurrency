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
                <?php require_once '../view/template/success_cart.php' ?>
                <?php require_once '../view/template/errors.php' ?>
            </div>
            <div class="container coins">
                <form class="form-inline" method="post" style="margin-top:50px">
                    <div class="row justify-content-center">
                        <div class="form-group mx-sm-3 mb-2 col-md-8">
                            <label for="exampleInputEmail1">入金額</label>
                            <div class="info">
                                <input type="text" name="money" class="form-control" id="inputPassword2">
                                <input class="tweet btn btn-primary mb-2 tweet"type="submit" name="atm" value="入金">
                            </div>
                        </div>
                    </div>
                </form>
                <?php if($total_money > 0){?>
                    <div class="info text-secondary">
                        <h2 class="text-dark"><?php print $username;?>さんの現在購入可能額：<?php print $total_money;?>円</h2>
                    </div>
                     <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">入金日時</th>
                          <th scope="col">入金額</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach($data as $key => $value){?>
                        <tr>
                          <th scope="row"><?php print $value['create_time'];?></th>
                          <td><?php print $value['money'];?></td>
                        </tr>
                        <?php } ?>
                    </table>
                <?php }else { ?>
                    <div style="text-align:center;margin:auto 0;">
                        <h1 style="margin-top:250px;margin-bottom:30px">入金履歴はございません</h1>
                    </div>
                <?php } ?>
            </div>   
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>