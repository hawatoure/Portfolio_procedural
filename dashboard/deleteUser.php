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



  

?>
      
<main>
    <div class="container text-center">
  
        <h2>Suppression de l'utilisateur</h2>
        <?php
        $id = $_GET["id_user"];
        require("../core/connexion.php");
        $sql = "SELECT id_user, nom, prenom, email, role
        FROM user
        WHERE id_user = $id
        ";
        $query = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
        $users = mysqli_fetch_assoc($query);
        ?>

        <h4>Attention vous êtes sur le point de supprimer l'user <?php echo $users["nom"] ." " . $users["prenom"] . " 😦 "?> </h4>
        <a type="button" class="btn bg-white mt-5"  href="../dashboard/listUsers.php">Retour liste</a>
        <form action="../core/userController.php" method="POST">
            <input type="hidden" name="faire" value="delete">
            <input type="hidden" name="id" value="<?= $users["id_user"]?>">
            <button type="submit" class="btn bg-white mt-3">Supprimer</button>
        </form>
    </div>
</main>

<?php
include("../assets/inc/footerBack.php")
?>