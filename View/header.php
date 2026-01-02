<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
        <div class="container-fluid">

        <!-- Header gauche -->
            <!-- Administrateur -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') { ?>
                <a class="navbar-brand fw-bold" href="admin_dashboard.php">
                    Touche pas au Klaxon
                </a>
            <!-- Autre -->
            <?php } else { ?>
                <span class="navbar-brand fw-bold">
                    Touche pas au Klaxon
                </span>
            <?php } ?>

        <!-- Header droite -->
            <div class="d-flex align-items-center gap-3 ms-auto">
            
            <!-- Utilisateur connecté -->
                <?php if (isset($_SESSION['user_id'])) { ?>

                    <!-- Administrateur -->
                    <?php if ($_SESSION['user_role'] === 'admin') { ?>
                        <a href="admin_dashboard.php?section=users" class="btn btn-secondary btn-sm"> Utilisateurs </a>
                        <a href="admin_dashboard.php?section=agences" class="btn btn-secondary btn-sm"> Agences </a>
                        <a href="admin_dashboard.php?section=trajets" class="btn btn-secondary btn-sm"> Trajets </a>
                    

                    <!-- Utilisateur normal -->
                    <?php } else { ?>
                        <a href="create_trajet.php" class="btn btn-dark btn-sm"> Proposer un trajet </a>
                    <?php } ?>

                    <!-- Administrateur et Utilisateur normal -->
                    <span class="fw-semibold text-nowrap">
                        <?php echo htmlspecialchars("Bonjour " . $_SESSION['user_name']); ?>
                    </span>

                    <a href="../Deconnexion.php" class="btn btn-dark btn-sm"> Déconnexion </a>
                
                <!-- Utilisateur non connecté -->
                <?php } else { ?>
                    <a href="Connexion.php" class="btn btn-dark btn-sm"> Formulaire de Connexion </a>
                <?php } ?>

            </div>
        </div>
    </nav>
</header>