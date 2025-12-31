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
        if(strlower($agence['city_name'])===strlower($city_name)){
            $errors[]="Cette ville existe déja";
        }
    }
}
}




?>