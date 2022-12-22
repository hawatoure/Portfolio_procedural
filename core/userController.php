<?php
    session_start();

    // on analyse ce qu'il y a à faire :
    $action = "empty";
    // si la clé "faire" est détecté dans $_POST (avec la balise caché
    // input type = "hidden")
    if (isset($_POST["faire"])):
        // notre variable action est égale à la valeur de la clé faire
        $action = $_POST["faire"];
    endif;

    // on utilise un switch pour vérifier l'action
    switch ($action):
        // log-admin correspond à value="log-admin" dans l'input caché
        // du fichier admin/index.php
        case "log-admin":
            logAdmin();
        break;
        case "log-out":
            logOut();
        break;
        case "update":
            updateUser();
        break;
        case "delete":
            deleteUser();
        break;
    endswitch;

    // les différentes fonctions de notre controleur
    function logAdmin(){
        // besoin de notre connexion
        require("connexion.php");
        // vérification de l'email de l'admin qui est unique
        // préparation des données, formatage
        $login = trim(strtolower($_POST["login"]));
        // écriture SQL (Read au niveau  du CRUD) avec SELECT
        $sql = "SELECT *
                FROM user
                WHERE email = '$login'
        ";
        // execution de la requète
        $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
        // traitement des données
        // on vérifie que l'email existe, pour se faire on utilise la fonction mysqli_num_rows() qui compte le nombre de ligne
        if (mysqli_num_rows($query) > 0):
            // on met sous forme de tableau associatif les données de
            // l'admin récupéré
            $user = mysqli_fetch_assoc($query);
            // ensuite il faut vérifier le mot de passe
            // le but c'est de vérifier si le mot de passe saisie = à l'encodage stocké en bdd
            // avec la fonction password_verify() qui nous renvoie true ou false, on vérifie le mot de passe.


            
            if (password_verify(trim($_POST["password"]), $user["password"])):
                // vérifier le rôle
                // on dit que 1 c'est le role admin
                if ($user["role"] != 1):
                    // on envoie un message d'alerte
                    $_SESSION["message"] = "Vous n'êtes pas l'administrateur de ce site";
                    // redirection vers la page d'accueil
                    header("Location:../index.php");
                    exit;
                else:
                    // on crée plusieurs variables de session qui
                    // permettent un affichage personnalisé et de sécuriser l'accès du back-office
                    $_SESSION["prenom"] = $user["prenom"];
                    $_SESSION["isLog"] = true;
                    $_SESSION["role"] = $user["role"];
                    header("Location:../dashboard/accueilAdmin.php");
                    exit;
                endif;
            else:
                // sinon erreur de mot de passe
                $_SESSION["message"] = "Erreur de mot de passe !!!";
                header("Location:../dashboard/index.php");
                exit;
            endif;
        else:
            // sinon pas d'utilisateur identifié
            $_SESSION["message"] = "Désolé, pas d'administrateur identifié !!!";
            header("Location:../dashboard/index.php");
            exit;
        endif;
 }

    function logOut(){
        // Pour déconnecter l'admin, il faut supprimer les variable de session
        //on détruit la session avec session_destrou()
        session_destroy();
        session_start();
        //redirection vers page d'accueil du site
        $_SESSION["message"] = "Vous êtes déconnecté";
        header("Location:../dashboard/index.php");
        exit;
    }

    //Mise à jour des informations de l'utilisateur

    function updateUser(){

        //vérifie si les informations ont bien été envoyées
        if(!isset($_POST['nom'], $_POST['prenom'],$_POST['email'],$_POST['role'], $_POST['id_user'])){
                $_SESSION['message'] = "Les données de cet utilisateur ne sont pas définis";
                header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;
        }




        //Récupérer les infos envoyées par le formulaire
        $nom = ucfirst(trim($_POST['nom']));
        $prenom = ucfirst(trim($_POST['prenom']));
        $email = strtolower(trim($_POST['email']));
        $role = $_POST['role'];
        $password1 = trim($_POST["password"]);
        $id = $_POST['id_user'];

        //validation des informations
        if(strlen($nom) < 1 || strlen($nom) > 255 ){    
                $_SESSION['message'] = "Le nom doit avoir entre 1 et 255 caractères";
                header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;
        }
        if(strlen($prenom) < 1 || strlen($prenom) > 255 ){
                $_SESSION['message'] = "Le prénom doit avoir entre 1 et 255 caractères";
                header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;
        }
        if(strlen($email) < 1 || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL) ){

                $_SESSION['message'] = "L'email est un invalide";
                header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;
        
        }
        if(strlen($role) != 1 && strlen($role) != 2){

            $_SESSION['message'] = "Le role n'existe pas";
            header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;
        }

        if(strlen($password1) < 1){

            $_SESSION['message'] = "Mot de passe incorrect";
            header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
            exit;
        }
        //encodage du password
        $option = ['cost => 12'];
        $password1 = password_hash($password1,PASSWORD_DEFAULT, $option);
        
        //Les données sont validées, préparons-nous à les envoyer en bdd
        require("connexion.php");

        $sql = "UPDATE user 
        SET 
        `nom` = '$nom', 
        `prenom` = '$prenom', 
        `email` = '$email',
        `role` = $role,
        `password` = '$password1'
        WHERE `id_user` = $id
        ";
        var_dump($sql);
        var_dump($_POST);

        $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
        $_SESSION['message'] = "Les données ont bien été mises à jour";
        header("Location:../dashboard/detailsUser.php?id_user=". $_POST['id_user']);
        exit;

  
    }





    function deleteUser(){
        //recupération de la connexion
        require("connexion.php");
        //recupération de l'id dans l'input caché du formulaire du bouton qui à le name="id"
        $id = $_POST['id'];
        $sql = "DELETE FROM user WHERE id_user = $id";
        $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
        $_SESSION["message"] = "Lutilisateur a bien été supprimé";
        header("Location:../dashboard/listUsers.php");

    }

    

    ?>