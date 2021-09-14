<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CoinShop</title>
        <?php require_once '../view/template/bootstrap.php' ?>
        <link rel="stylesheet" href="asserts/css/register.css">
    </head>
    <body class="bg-light">
        <header>
            <nav class="navbar navbar-light bg-light">
                <div class="container">
                    <span class="navbar-brand mb-0 h1 text-primary">Coinshop</span>
                </div>
            </nav>
        </header>
        <main>
            <div class="container login">
                <h1>新規会員登録</h1>
                <?php require_once '../view/template/errors.php' ?>
                <form method="post">
                    <p><label> メールアドレス</label><br><input type="text" name="mail" class="bg-white" ></p>
                    <p><label>ユーザー名 </label><br><input type="text" name = "name" class="bg-white"></p>
                    <p><label>パスワード </label><br><input type="password" name="passwd" class="bg-white"></p>
                    <p><label>性別 </label><br>
                            <select name="sex" class="bg-white">
                                <option value="1">男性</option>
                                <option value = "2">女性</option>
                            </select>
                    </p>
                    <p><label>生年月日 </label><br><input type="date" name="birth" value="2001-01-01" class="bg-white"></p>
                    <p class="text"><a href="login.php">ログインはこちら</a></p>
                    <input type="submit" name="register"  class="submit" value="登録する">
                </form>
            </div>
        </main>
        <?php require_once '../view/template/footer.php' ?>
    </body>
</html>
