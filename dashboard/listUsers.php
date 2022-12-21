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
                <th>Modification</th>  
                <th>Suppression</th>
            </tr>
            <tr>
        
            <?php
            
            foreach($users as $user){

            ?>
                <tr>
                    <td><a href='./detailsUser.php?id=<?=$user['id_user']?>'><?=$user['id_user']?><a></td>
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
                     <td><a href='?actions=update&id=<?=$user['id_user']?>'>Modifier<a></td>
                     <td><a href='?actions=delete&id=<?=$user['id_user']?>'>Supprimer<a></td>
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

        <button class="btn bg-light" name="update">Ajouter un utilisateur</button>


        <?php if ($mode_edition == 1) { ?>
        <h2>Edit user</h2>
        <?php foreach ($users as $user) :  ?>

        <form class="form-control" method="POST">

            <label for="nom">Nom</label></br>
            <input type="text" name="nom" placeholder="Votre nom" value="<?php echo $user['nom']; ?>"  /><br></br>
            <label for="prenom">Prénom</label></br>
            <input type="text" name="prenom" placeholder="Votre prenom" value="<?php echo $user['prenom']; ?>"  /><br></br>
            <label for="email">Email</label></br>
            <input name="email" placeholder="Votre email" value="<?php echo $user['email']; ?>" ></input><br></br>

            <input type="submit" name="modifier" value="Modifier"/><br>
        </form>

        <?php endforeach; ?>

  <?php } else { ?>
    
    <form method="POST">
          <label for="nom">Nom</label></br>
          <input type="text" name="nom" placeholder="Votre nom"/><br>
          <label for="prenom">Prénom</label></br>
          <input type="text" name="prenom" placeholder="Votre prenom" /><br>
          <label for="email">Email</label></br>
          <input name="email" placeholder="Votre email" ></input><br>

        <input type="submit" name="enregistrer" value="Enregistrer" /><br>
      </form>
      <?php } ?>
        
      
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>