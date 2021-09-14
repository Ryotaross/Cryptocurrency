<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset = "utf-8">
        <title>ユーザー管理</title>
        <?php require_once '../view/template/bootstrap.php' ?>
    </head>
    <body>
        <div class="container">
            <h1>ユーザー管理ページ</h1>
            <a href="tool.php">仮想通貨管理ページ</a>
            <form method="post">
                <input type="submit" name="logout" value="ログアウト">
            </form>
            <h2>ユーザ情報一覧</h2>
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ユーザー名</th>
                  <th scope="col">登録日時</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach((array)$data as $key => $value) { ?>
                    <tr>
                        <td scope="row"><?php print $value['username']?></td>
                        <td><?php print $value['create_date']?></td>
                    </tr>
                 <?php } ?> 
              </tbody>
            </table>
        </div>
    </body>
</html>