<?php

require_once "../../../Controller/AgenceController.php";
require_once "../../../Model/Agence.php";
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

//Verification connection + role=admin
if(!isset($_SESSION['user_id'])|| $_SESSION['user_role']!=='admin'){
    header("Location:../../Connexion.php");
    exit();
}

$agenceController=new AgenceController();
$agenceId=$_GET['id'];
$agences=$agenceController->getAllAgences();
$agenceDetails=null;
foreach($agences as $agence){
    if($agence['id']==$agenceId){
        $agenceDetails=$agence;
    }
}
if(!$agenceDetails){
    header("Location:../../index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $agence=new Agence();
    $agence->setCityName($_POST['city_name']);
    $agenceController->updateAgence($agence,$agenceId);

    //redirection après modification
    header("Location:../admin_dashboard.php?section=agences&updated=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Modification agence ADMIN</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include "../../header.php"; ?>

    <main class="flex-fill d-flex align-items-center justify-content-center">

        <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
            <div class="card-body">

                <h4 class="card-title mb-4 text-center">
                    Modifier une agence
                </h4>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Nom de l'agence</label>
                        <input type="text"
                               name="city_name"
                               class="form-control"
                               value="<?= htmlspecialchars($agenceDetails['city_name']) ?>"
                               required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-dark">
                            Enregistrer
                        </button>

                        <a href="../admin_dashboard.php?section=agences"
                           class="btn btn-outline-secondary">
                            Annuler
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </main>

    <?php include "../../footer.php"; ?>

</body>
</html>