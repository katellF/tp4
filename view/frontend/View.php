<?php

class View
{
    private $file;
    private $title;

    public function __construct($action) {
        // Détermination du nom du fichier vue à partir de l'action
        $this->file = "view/frontend/". $action ."View.php";
    }

    public function generate($datas) {
        // Génération de la partie spécifique de la vue
        $content = $this->generateFile($this->file, $datas);
        // Génération du template commun utilisant la partie spécifique
        $view = $this->generateFile('view/frontend/template.php',
            array('titre' => $this->title, 'content' => $content));
        // Renvoi de la vue au navigateur
        echo $view;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function genererFichier($file, $datas) {
        if (file_exists($file)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($datas);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $file;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$file' introuvable");
        }
    }
}