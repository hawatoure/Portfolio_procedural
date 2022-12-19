Nous allons créer un site Portefolio
    - partie front
    - partie back-office (admin) qui permettra au webmaster de configurer le site ou récupérer des informations



    - Au niveau de la bdd
        L'accès au back-office
        - une table user (avec plusieurs champs colonnes)
            -nom
            -prenom
            -email
            -password
            -role
        Messagerie
        -Une table message
            -nom
            -prenom
            -societe
            -email
            -telephone
            -description
            compétence
        un table front_end
            -titre
            -texte
            -image
            -lien
            -active
        un table back_end
            -titre
            -texte
            -image
            -lien
            -active


creation de l'architecture(arborescence des dossiers et fichiers)
création de la table user dans la bdd portfolio
création du dosiers et fichier aide/creerUnAdmin.php
    -ce fichier va nous permettre de créer un formulaire pour enregistrer un administateur qui aura
     acces au back office(console d'administration) de notre site(pour le portfolio vous-même)
Création d'une barre de navigation dans le fichier assets/inc/headerFront.php
Création du fichier admin/index.php qui va gérer le formulaire de connexion au back-office
Création du fichier core.userController.php qui va gérer les différentes fonctions (login logout et le CRUD de la table user)
Ces fonction prennent en charge les message flash
            