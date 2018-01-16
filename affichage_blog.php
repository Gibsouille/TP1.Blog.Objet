<?php
    include ("./html/head.html");
    include ("./Manager.php");
?>
        <h1>Blog</h1>
        <hr>
<?php
    $connexionDB = new PDO("mysql:host=localhost;dbname=blog", "root", ""); // connexion bdd
    $managerContenusBlog = new Manager($connexionDB);
    $contenusBlogs = $managerContenusBlog->lireTousLesContenus();

    if (count($contenusBlogs) == 0) {
        echo "<p>Aucun contenu</p>";
    }
    else {
        foreach ($contenusBlogs as $contenu) {
            $nom_image = $contenu->getCheminPhoto();
            $source_image = "./photos/" . $nom_image;
            echo '
            <section>
                <h2>' . $contenu->getTitre() . '</h2>
                <h3>Le ' . $contenu->getDateEntree() . '</h3>
                <p>' . $contenu->getCommentaire() . '</p>
                <img src="' . $source_image . '" alt="' . $nom_image . '" />
                <hr>
            </section>';
        }
    }
    
    echo '<a href="./formulaire_ajout.php">Insérer du nouveau contenu</a>';
    
    include ("./html/foot.html");