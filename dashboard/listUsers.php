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
    require("../core/connexion.php");
    $sql = "SELECT `id_user`, `nom`, `prenom`, `email`, `role` 
            FROM `user` ";
           $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
           $users = mysqli_fetch_all($query, MYSQLI_ASSOC);
          
?>
    <?php

// echo "<pre>"; 
// var_dump($users);
// echo "</pre>";
?>
<title>Liste des utilisateurs à inscrits</title>

<?php
     include("../assets/inc/headerBack.php");  
    //  echo "<pre>";
    //  var_dump($_SESSION);
    //  echo "</pre>";
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col- mt-3">
                <h1 class="text-center">Liste des utilisateurs inscrits</h1>
            </div>
        </div>
        <table class="table ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">email</th>
                <th scope="col">Rôle</th>   
                <th>Supprimer</th>
            </tr>
            <tr>
        
            <?php
            
            foreach($users as $user){

            ?>
                <tr>
                    <td><?= $user['id_user']  ?></td>
                    <td><?= $user['nom']  ?></td>
                    <td><?= $user['prenom']  ?></td>
                    <td><?= $user['email']  ?></td>
                    <td><?php
                    if($user['role']==1){
                        echo "Administrateur";
                    } else{
                        echo "Utilisateur";
                    }
                     ?></td>
                     <td><button class="btn bg-light">Supprimer</button></td>

                </tr>
          <?php
                // echo "<h4>Utilisateur : " . $user['nom']. "</h4>";
                //     echo "<pre>";
                //     var_dump($user);
                //     echo "</pre>";
            }


            ?>
            </tr>
        </table>
 
      
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>