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
    <link rel="stylesheet" href="assets/css/style.css">
    <title> Page de connexion</title>
    
</head>

<body class="page-connexion d-flex flex-column min-vh-100">

    <main class="container my-5">
        <div class="container-connexion d-flex justify-content-center mt-5">
            <div class="login-box p-4 ">
                <h2 class="connexion-title text-center mb-4">Connexion</h2>

                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php } ?>

                <form method="POST" class="form-connexion">

                    <div class="mb-3">
                        <label class="form-label">Email :</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mot de passe :</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-connect">
                            Se connecter
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <?php include "footer.php" ?>
    
</body>
</html>