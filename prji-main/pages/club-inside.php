<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

// Get the club id from the URL
if (isset($_GET['id'])) {
    $club_id = $_GET['id'];

    // Fetch club details from the database
    $stmt = $conn->prepare('SELECT * FROM clubs WHERE id = ?');
    $stmt->execute([$club_id]);
    $club = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if club exists
    if (!$club) {
        die("Club non trouvé.");
    }
} else {
    die("ID du club manquant.");
}
?>
<?php include '../includes/includes-header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../css/styles.css">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($club['name']); ?> - Club Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .club-details-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .club-details-container h1 {
            font-size: 2em;
            color: #333;
        }

        .club-details-container p {
            font-size: 1.2em;
            color: #555;
            line-height: 1.6;
        }

        .club-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    

    <div class="club-details-container">
        <h1><?php echo htmlspecialchars($club['name']); ?></h1>
        
        <?php if (!empty($club['image'])): ?>
    <img src="../assets/image/<?php echo htmlspecialchars($club['image']); ?>" alt="<?php echo htmlspecialchars($club['name']); ?>" class="club-image">
<?php endif; ?>
        
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($club['description'] ?? 'Aucune description disponible.')); ?></p>
        <p><strong>Activités:</strong> <?php echo nl2br(htmlspecialchars($club['activities'] ?? 'Aucune activité mentionnée.')); ?></p>
        <p><strong>Nombre de membres:</strong> <?php echo htmlspecialchars($club['members_count'] ?? '0'); ?></p>

        <a href="clubs.php" class="btn">Retour à la liste des clubs</a>
    </div>

    <?php include '../includes/includes-footer.php'; ?>
</body>
</html>
