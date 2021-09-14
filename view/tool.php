<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>仮想通貨管理</title>
        <?php require_once '../view/template/bootstrap.php' ?>
    </head>
    <body class="bg-light">
        <div class="container">
            <h1 style="border-bottom:solid 1px;">仮想通貨管理ツール</h1>
            <a href="admin.php">ユーザー管理ページ</a>
            <form method="post">
                <input type="submit" name="logout" value="ログアウト">
            </form>
            <h2 style="margin-top:20px;">新規通貨追加</h2>
            <?php require_once '../view/template/success.php' ?>
            <?php require_once '../view/template/errors.php' ?>
            <form method="post" enctype="multipart/form-data" name='add'>
              <div class="form-group">
                <label for="exampleInputEmail1">名前</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">価格</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="price">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">在庫数</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="quantity">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">説明</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="explain"></textarea>
              </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">画像</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="photo">
                </div>
                <div class="form-group">
                  <label for="inputState">公開設定</label>
                  <select id="inputState" class="form-control" name="status">
                    <option value="1">公開</option>
                    <option value="0">非公開</option>
                  </select>
                 </div>
              <input type="submit" class="btn btn-primary" name="submit" value="追加" >
            </form>
            <h2 style="margin-top:20px;">商品一覧</h2>
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">商品画像</th>
                  <th scope="col">商品名</th>
                  <th scope="col">価格</th>
                  <th scope="col">在庫数</th>
                  <th scope="col">ステータス</th>
                  <th scope="col">説明</th>
                  <th scope="col">削除</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($data as $key => $value) { ?>
                <tr>
                  <th scope="row"><img style="width:100px;" src="<?php print $img_dir . $value['img'];?>"></th>
                  <td><?php print $value['name'];?></td>
                  <td><?php print $value['price'];?></td>
                  <td>
                      <form method="post">
                            <input class="quantity bg-white" type="text" name="change" value="<?php print $value['stock'];?>">個
                            <input class="btn btn-primary"type="submit" name = "change_explain" value="変更">
                            <input type="hidden" name="change_id" value="<?php print $value['id'];?>">
                        </form>
                  </td>
                  <td>
                        <form method='POST'>
                            <?php if($value['status'] === 1){ ?>
                            <input class="status btn btn-primary" type="submit" name="status_show" value="公開→非公開">
                            <input type="hidden" name="status_id" value="<?php print $value['id'];?>">
                            <?php }else{ ?>
                            <input class="status btn btn-primary" type="submit" name="status_unshow" value="非公開→公開">
                            <input type="hidden" name="status_id" value="<?php print $value['id'];?>">
                            <?php }?>
                        </form>
                    </td>
                     <td>
                        <form method="post">
                            <textarea class="explain bg-white" name="change_exp"><?php print $value['exp'];?></textarea>
                            <input class="btn btn-primary" type="submit" value="変更">
                            <input type="hidden" name="change_id" value="<?php print $value['id'];?>">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input class="delete btn btn-danger" type="submit" name="delete" value="削除">
                            <input type="hidden" name="change_id" value="<?php print $value['id'];?>">
                            <input type="hidden" name="change_img" value="<?php print $value['img'];?>">
                        </form>
                    </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </body>
</html>