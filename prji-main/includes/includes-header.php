<?php
// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the functions file where isLoggedIn() is defined
require_once '../includes/includes-functions.php';
?>
<header>
    <nav>
        <div class="logo">
            <a href="index.php">GestionClubs</a>
        </div>
        <ul>
            <li><a href="index.php" <?php if (isset($current_page) && $current_page == 'index') echo 'class="active"'; ?>>Accueil</a></li>
            <li><a href="clubs.php" <?php if (isset($current_page) && $current_page == 'clubs') echo 'class="active"'; ?>>Clubs</a></li>
            <li><a href="evenements.php" <?php if (isset($current_page) && $current_page == 'evenements') echo 'class="active"'; ?>>Événements</a></li>
            <li><a href="contact.php" <?php if (isset($current_page) && $current_page == 'contact') echo 'class="active"'; ?>>Contact</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="compte.php" <?php if (isset($current_page) && $current_page == 'compte') echo 'class="active"'; ?>>Mon compte</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="connexion.php" <?php if (isset($current_page) && $current_page == 'connexion') echo 'class="active"'; ?>>Connexion</a></li>
                <li><a href="inscription.php" <?php if (isset($current_page) && $current_page == 'inscription') echo 'class="active"'; ?>>Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>