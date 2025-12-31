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
    <title>Modification agence ADMIN</title>
</head>

<body>
    <?php include "../../header.php"?>
    <br>
    <form method='POST'>
        <label>Nom de l'agence</label>
        <input type="text" name="city_name" value="<?php echo $agenceDetails['city_name']?>">
        <button type="submit">Enregistrer les modifications</button>
        <a href="../admin_dashboard.php?section=agences">
            <button type="reset">Annuler</button>
        </a>
    </form>
    <br>
    <?php include "../../footer.php"?>
</body>
</html>