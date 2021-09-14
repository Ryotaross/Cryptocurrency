<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- JavaScriptを使用する場合 -->
        <!-- jQuery、Popper.js、Bootstrap.jsの順番で読み込みます（下記はbundle版を使用） -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <style>
            .list{
                background-color:pink;
                border:solid 2px blue;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
          <!-- Brand -->
          <a class="navbar-brand" href="#">Navbar</a>
        
          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <!-- Navbar links -->
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
            </ul>
          </div>
        </nav>
        
        
        <div class='container-fluid'>
            <div class='row'>
                <div class='list col-12 col-sm-6 col-md-4 col-lg-3'>aaa</div>
                <div class='list col-12 col-sm-6 col-md-4 col-lg-3'>bbb</div>
                <div class='list col-12 col-sm-6 col-md-4 col-lg-3'>ccc</div>
                <div class='list col-12 col-sm-6 col-md-4 col-lg-3'>ddd</div>
            </div>
        </div>
        
    </body>
</html>