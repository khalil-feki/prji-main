<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

if (isLoggedIn()) {
    header('Location: compte.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (registerUser($conn, $name, $email, $hashed_password)) {
            $success_message = 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.';
        } else {
            $error_message = 'Une erreur s\'est produite lors de la création du compte.';
        }
    } else {
        $error_message = 'Les mots de passe ne correspondent pas.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>

    <main class="inscription-container" style="margin-top: 150px;" pading="20px">
        <h1>Inscription</h1>
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form id="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); max-width: 400px; margin: 0 auto;">
    <div style="padding: 10px; margin-bottom: 15px;">
        <label for="name" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Nom</label>
        <input type="text" id="name" name="name" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
    </div>
    <div style="padding: 10px; margin-bottom: 15px;">   
        <label for="email" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Email</label>
        <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
    </div>
    <div style="padding: 10px; margin-bottom: 15px;">
        <label for="password" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Mot de passe</label>
        <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
    </div>
    <div style="padding: 10px; margin-bottom: 20px;">
        <label for="confirm-password" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Confirmer le mot de passe</label>
        <input type="password" id="confirm-password" name="confirm-password" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
    </div>
    <button type="submit" class="btn" style="background: #3498db; color: white; border: none; padding: 12px 24px; border-radius: 6px; width: 100%; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease;">S'inscrire</button>
</form>
</main>

    <?php include '../includes/includes-footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>
