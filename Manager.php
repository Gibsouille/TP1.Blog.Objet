<?php
include ("./ContenuBlog.class.php");
include ("./User.class.php");

class Manager {
    private $connexionDB;
    
    public function __construct($connexionDB) {
        $this->connexionDB = $connexionDB;
    }
    
    public function __get($property) {
        throw new Exception("Attribut invalide ! Utilisez la méthode get_" . $property . "() s'il elle existe pour accéder à la valeur de l'attribut.");
    }
    
    public function __set($property, $value) {
        throw new Exception("Attribut invalide ! Utilisez la méthode set_" . $property ."(" . $value . ") si elle existe pour modifier l'attribut.");
    }
    
    public function ajouterContenuBlog($contenu) {
        try {
            $insertContenu = $this->connexionDB->prepare("INSERT INTO contenu(titre, id_user, commentaire, chemin_photo) values(:titre, :id_user, :commentaire, :chemin_photo)");
            $insertContenu->execute(array(
                'titre' => $contenu->getTitre(),
                'id_user' => $contenu->getUser()->getIdUser(),
                'commentaire' => $contenu->getCommentaire(),
                'chemin_photo' => $contenu->getCheminPhoto()
            ));
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    }
    
    public function lireTousLesContenus() {
        $contenus = array();
        
        try {
            $selectContenus = "select * from contenu order by date_entree asc";
            $reponse = $this->connexionDB->query($selectContenus);

            while (($ligneReponse = $reponse->fetch())) {
                $userDuContenu = $this->selectUserParIdUser($ligneReponse['ID_USER']);
                $contenuBlog = new ContenuBlog($ligneReponse['ID_CONTENU'], $ligneReponse['TITRE'], $userDuContenu, $ligneReponse['DATE_ENTREE'], $ligneReponse['COMMENTAIRE'], $ligneReponse['CHEMIN_PHOTO']);
                array_push($contenus, $contenuBlog);
            }

            $reponse->closeCursor();
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
        
        return $contenus;
    }
    
    public function verifierSiUserExiste($pseudo) {
        try {
            $selectUser = "select count(*) as nb_users from user where pseudo = '" . $pseudo . "'";
            $reponse = $this->connexionDB->query($selectUser);
            
            if ($reponse->fetch()['nb_users'] > 0) {
                return true;
            }
            
            return false;
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    }
    
    public function ajouterUser($user) {
        try {
            $insertUser = $this->connexionDB->prepare("INSERT INTO user(pseudo) values(:pseudo)");
            $insertUser->execute(array(
                'pseudo' => $user->getPseudo()
            ));
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    }
    
    public function selectUserParPseudo($pseudo) {
        $user = NULL;
        
        if ($this->verifierSiUserExiste($pseudo)) {
            try {
                $selectUser = "select * from user where pseudo = '" . $pseudo . "'";
                $reponse = $this->connexionDB->query($selectUser);

                $ligneReponse = $reponse->fetch();

                $user = new User($ligneReponse['id_user'], $ligneReponse['pseudo']);
            }
            catch (PDOException $ex) {
                echo 'Erreur : ' . $ex.getMessage() . '\n';
            }
        }
        
        return $user;
    }
    
    private function selectUserParIdUser($id_user) {
        try {
            $selectUser = "select * from user where id_user = '" . $id_user . "'";
            $reponse = $this->connexionDB->query($selectUser);

            $ligneReponse = $reponse->fetch();

            $user = new User($ligneReponse['id_user'], $ligneReponse['pseudo']);
            return $user;
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    }
}
