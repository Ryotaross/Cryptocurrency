<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/login.css">
        <link rel="stylesheet" href="asserts/css/register_complete.css">
    </head>
    <body class="bg-light">
         <header>
            <nav class="navbar navbar-light bg-light">
                <div class="container">
                      <span class="navbar-brand mb-0 h1 text-primary">Coinshop</span>
                </div>
            </nav>
        </header>
        <main class="main">
            <div class="container login">
                <div class="text">
                    <h1>登録が完了しました。</h1>
                    <h1><a href="../login.php">ログインページ</a>に移動</h1>
                </div>
            </div>
        </main>
       <?php require_once '../view/template/footer.php' ?>
    </body>
</html>
