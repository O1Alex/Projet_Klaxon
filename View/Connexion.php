<?php

session_start();

require "../Controller/UserController.php";


$userController=new UserController();
$error='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    if($userController->Connexion($_POST["email"],$_POST['password'])){
        header('Location:index.php');
        exit;
    }
    else{
        $error="Email ou mot de passe incorrect";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title> Page de connexion</title>
    
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card border-2" style="width: 25rem;">
            <div class="card-body">
                <h2 class="card-title text-center">Connexion</h2>
                <br>

                <!-- Erreurs -->
                <?php 
                    if ($error) {?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?=$error?>
                        </div>
                    <?php }; ?>

                <!-- Formulaire de connexion -->
                <form class="card-text text-center mb-3" method="POST">
                    <div>
                        <label>Email :</label>
                        <input type="email" name="email" required>
                    </div>
                    <br>

                    <div>
                        <label>Mot de passe :</label>
                        <input type="password" name="password" required>
                    </div>
                    <br>

                    <button class="btn btn-dark rounded" type="submit">Se connecter</button>
                </form>
                
            </div>
        </div>
    </div>

</body>
</html>