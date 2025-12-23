<?php
session_start();
require_once "../Controller/TrajetController.php";

$trajetController=new TrajetController();
$trajetId=$_POST['trajet_id'];

$result=$trajetController->deleteUserTrajet($trajetId,$_SESSION['user_id']);

if($result['success']){
    header('Location:homepage.php?deleted=1');
 } else{
    header('Location:homepage.php?error=delete'); 
}
exit();

?>