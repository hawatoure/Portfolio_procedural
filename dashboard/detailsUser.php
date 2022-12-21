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
    $id = $_GET['id'];

    require("../core/connexion.php");

    $sql = "SELECT `id_user`, `nom`, `prenom`, `email` 
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
                <h1 class="text-center">Détails de l'utilisateur <?= $_GET["id"] ?></h1>
            </div>
        </div>
        "<div class="row justify-content-center mt-4 text-center">
          
          
     
          <?php
                // echo "<h4>Utilisateur : " . $user['nom']. "</h4>";
                //     echo "<pre>";
                //     var_dump($user);
                //     echo "</pre>";

             
                
                echo 'Bienvenu sur le compte n° : '. $users['id_user']. "<br>";
                echo $users['nom']." " ;
                echo $users['prenom']. "<br>";
                echo $users['email'];
                

            ?>
        </div>
        
    
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>