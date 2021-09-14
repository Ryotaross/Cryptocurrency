<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/login.css">
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
            <?php require_once '../view/template/errors.php' ?>
            <div class="container login">
                <h2>ログイン</h2>
                <form method="post">
                    <p><label> ユーザ名</label><br><input type="text" name="name" class="bg-white"></p>
                    <p><label>パスワード </label><br><input type="password" name = "passwd" class="bg-white"></p>
                    <p class="text"><a href="register.php">登録はこちら</a></p>
                    <input type="submit" name="login"  class="submit" value="ログイン">
                </form>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>