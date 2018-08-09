<?php
$title = 'Se déconnecter';
?>
<?php ob_start(); ?>

    <form method="post" action="controleurLogout.php">

        <p>
            <input type="hidden" name="action" value="logout"/>
            <input type="submit" value="Se déconnecter"/>
        </p>

    </form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
