<?php
require_once __DIR__.'/../../../Controller/TrajetController.php';

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

//Verification connection + role=admin
if(!isset($_SESSION['user_id'])||$_SESSION['user_role']!=='admin'){
    header('Location:../../Connexion.php');
    exit();
}

$trajetId=$_POST['id'];
$trajetController=new TrajetController();

try{
    $trajetController->deleteTrajet($trajetId);
    header('Location:../admin_dashboard.php?section=trajets&deleted=1');
    exit();
}catch(Exception $e){
    header('Location:../admin_dashboard.php?section=trajets&error=1');
}




?>