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
<title>Console d'administration</title>

<?php
     include("../assets/inc/headerBack.php");  
     echo "<pre>";
     var_dump($_SESSION);
     echo "</pre>";
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col- mt-3">
                <h4 class="text-center">Bienvenue dans votre tableau de bord <?= $_SESSION["prenom"] ?></h4>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                <form action="../core/userController.php" method="post">
                    <input type="hidden" name="faire" value="log-out">
                    <button type="submit" class='btn mt-3 text-align bg-light fw-bold' name="soumettre">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>
</main>









<?php
    
    include("../assets/inc/footerBack.php");


?>