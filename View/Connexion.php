<?php

session_start();

require "../Controller/UserController.php";


$userController=new UserController();
$error='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    if($userController->Connexion($_POST["email"],$_POST['password'])){
        header('Location:header.php');//redirection
        exit;
    }
    else{
        $error="Email ou mot de passe incorrect";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h2>Connexion</h2>

    <!-- Erreurs -->
    <?php 
        if ($error) {?>
        <p style="color:red"><?=$error?></p>
        <?php }; ?>


    <!-- Formulaire de connexion -->
    <form method="POST">
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <br>

        <div>
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <br>

        <button type="submit">Se connecter</button>
    </form>
    
</body>
</html>