<?php if(isset($_SESSION['success'])===true){ ?>

    <?php foreach($_SESSION['success'] as $success){ ?>
    <div class="alert alert-primary" role="alert">
        <?php print $success; ?>
    </div>
    <?php } ?>
    <?php $_SESSION['success'] = []; ?>

<?php } ?>