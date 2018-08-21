<?php

session_start();
$title = 'Billet';
?>
<?php ob_start(); ?>

<form method="post" action="index.php?action=billet">
    <p>
        <label for="title">Titre</label><input type="text" name="title" id="title" value=""   />
    </p>

    <p>
        <label for="content">Contenu</label><textarea name="content" id="content" value=""></textarea>
    </p>

    <p>
        <input type="submit" value="Enregistrer"/>
    </p>

</form>

<?php $content = ob_get_clean();
var_dump($_SESSION);;?>

<?php require('template.php'); ?>
