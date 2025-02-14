<?php
session_start(); // Start the session at the beginning of the file
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php'); // Redirect to login page if not logged in
    exit(); // Stop further execution
}

if (isset($_POST['club_id'])) {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $club_id = $_POST['club_id']; // Get the club ID from the form submission

    // Check if the user is already a member of the club
    $stmt = $conn->prepare('SELECT COUNT(*) FROM club_members WHERE user_id = ? AND club_id = ?');
    $stmt->execute([$user_id, $club_id]);
    $is_member = $stmt->fetchColumn();

    if ($is_member) {
        // If the user is already a member, display a message or do nothing
        echo "<script>alert('Vous êtes déjà membre de ce club.');</script>";
    } else {
        // If the user is not a member, insert into club_members table
        try {
            $stmt = $conn->prepare('INSERT INTO club_members (user_id, club_id) VALUES (?, ?)');
            $stmt->execute([$user_id, $club_id]);

            // Optionally, redirect after joining
            header('Location: clubs.php'); // Redirect back to clubs page after joining
            exit();
        } catch (PDOException $e) {
            // Handle any SQL errors
            die("Erreur lors de l'inscription au club : " . $e->getMessage());
        }
    }
}

$clubs = getClubs($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs - Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>

    <main>
        <h1>Nos clubs</h1>
        <div class="clubs">
            <?php foreach ($clubs as $club): ?>
                <div class="club">
                    <img src="../assets/image/<?php echo $club['image']; ?>" alt="<?php echo $club['name']; ?>">
                    <h3><?php echo $club['name']; ?></h3>
                    <p><?php echo $club['description']; ?></p>
                    <p><strong>Activités:</strong> <?php echo $club['activities']; ?></p>
                    <p><strong>Membres:</strong> <?php echo $club['members_count']; ?></p>
                    <a href="club-inside.php?id=<?php echo $club['id']; ?>" class="btn">En savoir plus</a>



                    <!-- Join Club Form -->
                    <form method="POST" action="clubs.php">
                        <input type="hidden" name="club_id" value="<?php echo $club['id']; ?>">
                        <button type="submit" class="btn join-btn">Rejoindre</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../includes/includes-footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>
