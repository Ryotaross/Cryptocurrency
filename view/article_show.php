<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Open+Sans&display=swap" rel="stylesheet">
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/show.css">
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
                <?php require_once '../view/template/success.php' ?>
                <?php require_once '../view/template/errors.php' ?>
            </div>
            <div class="container coins">
                <div class="coin">
                    <div class="row justify-content-center">
                        <h2 class="text-dark"><?php print $data[0]['title'];?></h2>
                        <div class="col-11">
                            <h3><?php print $data[0]['username'];?></h3>
                            <p><?php print $data[0]['update_date'];?></p>
                        </div>
                        <div class="row">
                            <p class="col-md-12"><?php print $data[0]['article'];?></p>
                        </div>
                    </div>
                </div>
                <div class="review">
                    <h2>レビュー</h2>
                    <?php foreach ($review as $key => $value){ ?>
                        <div class="row justify-content-center">
                            <div class="card w-75 col-8">
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
                                    <input class="btn btn-primary mb-2"type="submit" name="throw" value="送信">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>