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
    <title>Tableau de bord</title>
</head>
<body class="dashboard d-flex flex-column min-vh-100">

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
    
    <main class="container dashboard-case my-5 py-5">
        <h1 class="dashboard-title mb-4 text-center">Bienvenue sur le tableau de bord</h1>
        <div class="dashboard-description text-center mt-4">
            <p>Vous aurez accès ici à tout ce dont vous aurez besoin afin de repondre au beosin de nos utilisateurs.<br> Rendez vous dans les onglet du menu et bonne navigation !</p>
        </div>
    </main>

<?php } ?>

<?php include "../footer.php"; ?>

</body>
</html>
