<?php

if(session_status()==PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user_id']) || $_SESSION['user_role']!== 'admin' ){
    header('Location:../Connexion.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include "../header.php"; ?>

    <?php $section=$_GET['section']?? '';

    switch($section){
        case 'users':
            include 'Users/list_users.php';
            break;
        case 'agences':
            include 'Agences/list_agences.php';
            break;
        case 'trajets':
            include 'Trajets/list_trajets.php';
            break;
        default: ?>
    
    <main class="container my-5">
        <h1 class="mb-4 text-center">Bienvenue sur le tableau de bord</h1>
        <div class="text-center mt-4">
            <p>Vous aurez accès ici à tout ce dont vous aurez besoin afin de repondre au beosin de nos utilisateurs.<br> Rendez vous dans les onglet du menu et bonne navigation !</p>
        </div>
    </main>

<?php } ?>

<?php include "../footer.php"; ?>

</body>
</html>
