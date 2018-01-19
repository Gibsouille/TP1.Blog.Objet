<?php
    include ("./html/header.html");
    include ("./Manager.php");
    
    $uploaddir = './photos/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile) && isset($_POST['titre']) && isset($_POST['pseudo'])) {
        $titre = $_POST['titre'];
        $pseudo = $_POST['pseudo'];
        $commentaire = $_POST['commentaire'];
        $chemin_photo = $_FILES['photo']['name'];
        
        if (empty(trim($commentaire))) {
            $commentaire = NULL;
        }
        
        $connexionDB = new PDO("mysql:host=localhost;dbname=blog", "root", "");
        $managerContenusBlog = new Manager($connexionDB);
        $user = new User(NULL, $pseudo);
        
        if ($managerContenusBlog->verifierSiUserExiste($user->getPseudo()) === false) {
            $managerContenusBlog->ajouterUser($user);
        }
        
        $user = $managerContenusBlog->selectUserParPseudo($user->getPseudo());
        $contenuBlog = new ContenuBlog(NULL, $titre, $user, NULL, $commentaire, $chemin_photo);
        
        $contenusBlogs = $managerContenusBlog->ajouterContenuBlog($contenuBlog);

        echo "Aucune erreur dans le transfert du fichier.\n"
            . "Le fichier " . $contenuBlog->getCheminPhoto() . " a été copié dans le répertoire photos.\n"
            . "Ajout du commentaire réussi.\n";
    } else {
        echo "Le fichier n'a pas pu être téléchargé. Vérifiez les entrées du formulaire.\n";
    }
    
    echo '</pre>';
    
    echo '<a href="./formulaire_ajout.php">Retour à la page d\'insertion</a>';
    
    include ("./html/footer.html");