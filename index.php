
<?php 

//on initialise la superGlobale $_SESSION

include("assets/inc/headFront.php"); 

?>

    <title>Portfolio</title>

    <?php include("assets/inc/headerFront.php"); ?>

    <main>
    <!-- ????-->
        <!--Gestion de l'affichage des messages -->
        <div class="row">
    <?php
                if (isset($_SESSION["message"])):
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION["message"] . '</div>';
                    // on efface la clé message, une fois qu'elle a été affichée avec unset()
                    unset($_SESSION["message"]);
                endif;
            ?>
    </div>

    <?php
    // $str = "Bonjour";
    // echo "$str";
    // echo "'" 

    //echo $_SESSION["message"]

    ?>

    </main>

    <?php include("assets/inc/footerFront.php"); ?>