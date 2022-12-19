<?php
include("../assets/inc/headFront.php");


// Dans ce fichier on va créer la page de connexion avec notre back office
include("../assets/inc/headerFront.php");

?>

<title>Login administrateur</title>

<main>
<div class="container">
    <!--Gestion de l'affichage des messages -->
    <div class="row">
    <?php
                if (isset($_SESSION["message"])):
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["message"] . '</div>';
                    // on efface la clé message, une fois qu'elle a été affichée avec unset()
                    unset($_SESSION["message"]);
                endif;
            ?>
    </div>
    <div class="row justify-content-center text-center">
    <h1>Login Admin</h1>
        <div class="col-4">
            <form class="form-group" action="../core/userController.php" method="post">
                <input type="hidden" name="faire" value="log-admin">
                <input type="email" class="mt-3 form-control" name="login" placeholder="Votre email">
                <input type="password" class=" mt-3 form-control" name="password" placeholder="Votre mot de passe">
                <button type="submit" class="btn mt-3 text-align bg-primary fw-bold" name="soumettre">Se connecter</button>
            </form>
        </div>
    </div>
</div>







</main>








<?php
    include("../assets/inc/footerFront.php");
?>