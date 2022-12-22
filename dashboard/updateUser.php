<?php
//session_start();
    include("../assets/inc/headBack.php");
    // if(!isset($_SESSION['isLog']) || $_SESSION['role'] !== "1"){
    //     $_SESSION["message"] = "Vous n'êtes pas connecté. Merci de vous identifier ";
    //     header("Location:../dashboard/index.php");
    // };

    if(!isset($_SESSION['isLog'], $_SESSION['role'], $_SESSION['prenom'])  || $_SESSION['role']!=1 || !$_SESSION['prenom'] || !$_SESSION['isLog']){
        $_SESSION["message"] = "Vous n'êtes pas connecté. Merci de vous identifier ";
        header("Location:../dashboard/index.php");
        exit;
    }
    // choix de l'id à ajouter
    $id = $_GET['id_user'];

    require("../core/connexion.php");

    $sql = "SELECT `id_user`, `nom`, `prenom`, `email`,`role` 
            FROM user 
            WHERE id_user = $id";

    $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));

    $users = mysqli_fetch_assoc($query);
  

?>
<title>Console d'administration</title>

<?php
     include("../assets/inc/headerBack.php");  
     echo "<pre>";
     var_dump($user);
     echo "</pre>";
?>
<!-- 1 . Afficher les information de l'utilisateur sur la page
     2 . Afficher un utilisateur en fonction de son id quand on click dessus depuis la liste des utilisateurs
        (listUsers.php) indice : paramètre GET dan l'url

-->
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col- mt-3">
                <h1 class="text-center">Modifier l'utilisateur <?= $_GET["id_user"] ?></h1>
            </div>
        </div>
        <div class="row justify-content-center mt-4 text-center">
          
          
     
  

        </div>
                <h4>Modifier l'utilisateur</h4>
        <div class="row mt-5">
                <?php
                if (isset($_SESSION["message"])):
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["message"] . '</div>';
                    // on efface la clé message, une fois qu'elle a été affichée avec unset()
                    unset($_SESSION["message"]);
                endif;
            ?>
        </div>
        <div class="justify-content-center col-4">

            <form class="form-group" action="../core/userController.php" method="POST">

                <input type="hidden" name="id_user" value="<?= $users['id_user']; ?>">
                <input type="hidden" name="faire" value="update">
                
                <label for="nom">Nom</label></br>
                <input type="text" value="<?= $users["nom"]?>" class="form-control" name="nom" /><br>
                
                <label for="prenom">Prénom</label></br>
                <input type="text" value="<?= $users["prenom"]?>" class="form-control" name="prenom" /><br>
                
                <label for="email">Email</label></br>
                <input type="email" name="email" value="<?= $users["email"]?>" class="form-control"  ><br>
                
                <label for="role">Rôle</label>
                <select name="role" class="form-control" id="role">
                    <option value="2" <?php if($users["role"] == 2){
                        echo "selected";
                    }  ?>>Utilisateur</option>
                    <option value="1" <?php if($users["role"] == 1){
                        echo "selected";
                    }  ?>>Administrateur</option>
                </select></br></br>
                <label for="password">Mot de passe</label></br>
                <input class="form-control" type="password" name="password" id="password"> <br>
                
                <button type="submit" class="btn bg-light" name="enregistrer" value="Enregistrer">Enregistrer</button><br>
            </form>
      </div>
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>