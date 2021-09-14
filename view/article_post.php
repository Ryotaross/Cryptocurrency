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
        <main class="main  text-secondary">
            <div class="container" >
                <?php require_once '../view/template/success.php' ?>
                <?php require_once '../view/template/errors.php' ?>
            </div>
            <div class="container coins">
                <form method="post" enctype="multipart/form-data" name='add'>
                  <div class="form-group">
                    <label for="exampleInputEmail1">タイトル</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">本文</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" name="article"></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" name="submit" value="投稿" >
                </form>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>