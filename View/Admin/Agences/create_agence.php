<?php 

require_once __DIR__."/../../../Controller/AgenceController.php";
require_once __DIR__."/../../../Model/Agence.php";

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

//Verification connection + role=admin
if(!isset($_SESSION['user_id'])|| $_SESSION['user_role']!=='admin'){
    header("Location:../../Connexion.php");
    exit();
}

$agenceController=new AgenceController();
$errors=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $city_name=trim($_POST['city_name']);

    if(empty($city_name)){
        $errors[]="Le nom de la ville est obligatoire";
    }
    else{
        $existingAgence=$agenceController->getAllAgences();
        foreach($existingAgence as $agence){
            if(strtolower($agence['city_name'])===strtolower($city_name)){
                $errors[]="Cette ville existe déja";
            }
        }
    }
}

if(empty($errors)){
    $agence=new Agence();
    $agence->setCityName($city_name);
    $agenceController->createAgence($agence);
    header('Location:../admin_dashboard.php?section=agences&created=1');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Création agence ADMIN</title>
</head>

<body>
    <?php include "../../header.php"?>

    <!-- Affichage des erreurs -->
    <?php if(!empty($errors)){?>
        <?php foreach($errors as $error){?>
            <p><?php echo $error ?></p>
            <?php } } ?>

    <form method="POST">
        <label>Nom de l'agence</label>
        <input type="text" name="city_name">
        <button type="submit">Créer l'agence</button>
        <a href="../admin_dashboard.php?section=agences" >
            <button type="reset"> Annuler</button>
        </a>
    </form>
    
    <?php include "../../footer.php"?>
</body>
</html>