<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
?>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light px-4 py-3">
        <div class="header-container container-fluid">

        <!-- Header gauche -->
            <!-- Administrateur -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') { ?>
                <a class="title navbar-brand fw-bold" href="admin_dashboard.php">
                    <h1>Touche pas au Klaxon</h1>
                </a>
            <!-- Autre -->
            <?php } else { ?>
                <span class=" title navbar-brand fw-bold">
                    <h1>Touche pas au Klaxon</h1>
                </span>
            <?php } ?>

        <!-- Header droite -->
            <div class=" header-right d-flex align-items-center gap-3 ms-auto">
            
            <!-- Utilisateur connecté -->
                <?php if (isset($_SESSION['user_id'])) { ?>

                    <!-- Administrateur -->
                    <?php if ($_SESSION['user_role'] === 'admin') { ?>
                        <a href="admin_dashboard.php?section=users" class="btn-menu  btn-sm mr-3"> Utilisateurs </a>
                        <a href="admin_dashboard.php?section=agences" class="btn-menu  btn-sm"> Agences </a>
                        <a href="admin_dashboard.php?section=trajets" class="btn-menu  btn-sm"> Trajets </a>
                        <span class="text fw-semibold text-nowrap">
                            <?php echo htmlspecialchars("Bonjour " . $_SESSION['user_name']); ?>
                        </span>
                        <a href="../Deconnexion.php" class="btn-connect btn-dark btn-sm"> Déconnexion </a>

                    <!-- Utilisateur normal -->
                    <?php } else { ?>
                        <a href="create_trajet.php" class="btn-menu btn-dark btn-sm"> Proposer un trajet </a>
                        <span class="fw-semibold text-nowrap">
                            <?php echo htmlspecialchars("Bonjour " . $_SESSION['user_name']); ?>
                        </span>
                        <a href="Deconnexion.php" class="btn-connect btn-dark btn-sm"> Déconnexion </a>
                    <?php } ?>
                
                <!-- Utilisateur non connecté -->
                <?php } else { ?>
                    <a href="Connexion.php" class="btn-connect btn-dark btn-sm"> Formulaire de Connexion </a>
                <?php } ?>

            </div>
        </div>
    </nav>
</header>