<?php

if(session_status()==PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user_id']) || $_SESSION['user_role']!== 'admin' ){
    header('Location:../Connexion.php');
    exit();
}

include "../header.php";
 
$section=$_GET['section']?? '';

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
    default:
    echo "<h2> Bienvenue sur le dashboard</h2>";

}

include "../footer.php";





?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
