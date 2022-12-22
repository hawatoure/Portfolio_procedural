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
            <?php
                if (isset($_SESSION["message"])):
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["message"] . '</div>';
                    // on efface la clé message, une fois qu'elle a été affichée avec unset()
                    unset($_SESSION["message"]);
                endif;
            ?>
        <div class="row justify-content-center">
        <div class="row mt-5">
              
        </div>
            <div class="col- mt-3">
                <h1 class="text-center">Liste des utilisateurs inscrits</h1>
            </div>
        </div>
        <table class="table text-center">
            <tr>
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">email</th>
                    <th scope="col">Rôle</th> 
                    <th>Détail</th>
                    <th>Modification</th>  
                    <th>Suppression</th>
                </thead>
            </tr>
            <tr>
        
            <?php
            
            foreach($users as $user){

            ?>
                    <tr><tbody>
                        <td><a href='./detailsUser.php?id_user=<?=$user['id_user']?>'><?=$user['id_user']?><a></td>
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

                          <td><a type="button" href='./detailsUser.php?id_user=<?=$user['id_user']?>'><img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/32/000000/external-loupe-ecommerce-dreamstale-lineal-dreamstale.png" weight="24px"/><a></td>
                        <td><a type="button" href='./updateUser.php?id_user=<?=$user['id_user']?>'><img src="https://img.icons8.com/material-outlined/24/000000/edit--v1.png"/><a></td>
                        <td><a type="button" href='./deleteUser.php?id_user=<?=$user['id_user']?>'><img src="https://img.icons8.com/material-two-tone/24/000000/filled-trash.png"/><a></td>
                    </tr>
            <?php
                    // echo "<h4>Utilisateur : " . $user['nom']. "</h4>";
                    //     echo "<pre>";
                    //     var_dump($user);
                    //     echo "</pre>";
                    }
                
                    ?>
                    </tr>
            </tbody>
        </table>

        <button class="btn bg-dark text-dark" name="update"><a class="btAjout" href="../dashboard/createUser.php">Ajouter un utilisateur</a></button>


      
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>