<?php $title = 'Mon blog';

session_start();

?>


<?php ob_start(); ?>

    <h1>Mon super blog !</h1>
    <p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
    <?php
}
$posts->closeCursor();

if ( isUserConnected() ) {
?>
    <div>
        <a href="index.php?action=billet">Ecrivez un article</a>
    </div>
<?php
    } else {
   ?>
    <div>
        <a href="index.php?action=connection">Se connecter</a>
    </div>
    </br>
    <div>
        <a href="index.php?action=registration">S'enregistrer</a>
    </div>
    <?php
    }
    ?>




<?php $content = ob_get_clean(); ?>

<?php require('template.php');


?>