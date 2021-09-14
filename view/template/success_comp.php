<?php if(isset($_SESSION['success'])===true){ ?>

    <?php foreach($_SESSION['success'] as $success){ ?>
    <div class="alert alert-primary" role="alert">
        <?php print $success; ?>　　<a href="/mypage.php">マイページに移動する</a>
    </div>
    <?php } ?>
    <?php $_SESSION['success'] = []; ?>

<?php } ?>