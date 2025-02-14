<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

if (isLoggedIn()) {
    header('Location: compte.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: compte.php');
        exit;
    } else {
        $error_message = 'Identifiants incorrects.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>

    <main style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); max-width: 400px; margin: 150px auto;">
    <h1 style="text-align: center; color: #2c3e50; margin-bottom: 30px; font-size: 24px;">Connexion</h1>
    
    <?php if (isset($error_message)): ?>
        <p style="color: #e74c3c; background: #fdeaea; padding: 10px; border-radius: 6px; margin-bottom: 20px; text-align: center;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="width: 100%;">
        <div style="padding: 10px; margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Email</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <div style="padding: 10px; margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 8px; color: #34495e; font-weight: 500; font-size: 14px;">Mot de passe</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
        </div>
        
        <button type="submit" class="btn" style="background: #3498db; color: white; border: none; padding: 12px 24px; border-radius: 6px; width: 100%; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease;">Connexion</button>
    </form>
</main>

    <?php include '../includes/includes-footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>
