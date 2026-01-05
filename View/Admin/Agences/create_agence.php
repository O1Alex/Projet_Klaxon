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

if(empty($errors)){
    $agence=new Agence();
    $agence->setCityName($city_name);
    $agenceController->createAgence($agence);
    header('Location:../admin_dashboard.php?section=agences&created=1');
    exit();

}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Création agence ADMIN</title>
</head>

<body class="create-agence d-flex flex-column min-vh-100">
    <?php include "../../header.php"?>

    <!-- Affichage des erreurs -->
    <?php if(!empty($errors)){?>
        <?php foreach($errors as $error){?>
            <p><?php echo $error ?></p>
            <?php } } ?>

    <main class="flex-fill container my-5 pt-4">

        <h2 class="create-agence-title text-center mb-4">
            Modifier une agence
        </h2>

        <form method="POST" class="form-admin mx-auto">

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Nom de l'agence</label>
                <div class="col-md-8">
                    <input type="text" name="city_name" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn-save py-2 px-4">
                    Enregistrer
                </button>

                <a href="../admin_dashboard.php?section=agences" class="btn-cancel py-2 px-4">
                    Annuler
                </a>
            </div>

        </form>
    </main>

    <?php include "../../footer.php"?>
</body>
</html>