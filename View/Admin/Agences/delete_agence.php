<?php
require_once __DIR__.'/../../../Controller/AgenceController.php';

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

//Verification connection + role=admin
if(!isset($_SESSION['user_id'])||$_SESSION['user_role']!=='admin'){
    header('Location:../../Connexion.php');
    exit();
}

$agenceId=$_POST['id'];
$agenceController=new AgenceController();

try{
    $agenceController->deleteAgence($agenceId);
    header('Location:../admin_dashboard.php?section=agences&deleted=1');
}catch(Exception $e){
    header('Location:../admin_dashboard.php?section=agences&error=1');
}




?>