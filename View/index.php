<?php
session_start();
//Redirection vers page d'accueil concerné

    if(isset($_SESSION['user_id'])){
        
        //Administrateur
        if($_SESSION['user_role']=='admin'){
            header('Location:admin_homepage.php');
            exit();          
        
        // Utilisateur normal
        } else {
            header('Location:homepage.php');
            exit();
        }
                 
    // Utilisateur non connecté
    } else {
        header('Location: homepage.php');
        exit();
    } 

    
?>