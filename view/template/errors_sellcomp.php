<?php if(isset($_SESSION['error'])===true){ ?>

    <?php foreach($_SESSION['error'] as $error){ ?>
    <div class="alert alert-danger" role="alert">
        <?php print $error; ?> <a href="/sell.php">戻る</a>
    </div>
    <?php } ?>
    <?php $_SESSION['error'] = []; ?>

<?php } ?>