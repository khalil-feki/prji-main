<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Send contact email
    $to = 'contact@example.com';
    $subject = 'Nouveau message de contact';
    $body = "Nom: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $success_message = 'Votre message a été envoyé avec succès.';
    } else {
        $error_message = 'Une erreur s\'est produite lors de l\'envoi du message.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Contact - Gestion des clubs universitaires</title>
    <style>
     

        .contact-form-container {
            max-width: 800px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-form-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .contact-form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-form-container label {
            font-size: 1.1em;
            color: #444;
        }

        .contact-form-container input,
        .contact-form-container textarea {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 1em;
            width: 100%;
        }

        .contact-form-container button {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            font-size: 1.1em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form-container button:hover {
            background-color: #0056b3;
        }

        .success-message,
        .error-message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
        }

        .success-message {
            background-color: #28a745;
        }

        .error-message {
            background-color: #dc3545;
        }

      
        
    </style>
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>

    <main>
        <div class="contact-form-container"style="margin-top: 200px;"> 
            <h1>Contactez-nous</h1>
            <?php if (isset($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form id="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn">Envoyer</button>
            </form>
        </div>
    </main>

    <?php include '../includes/includes-footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>
