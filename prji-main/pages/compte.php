<?php
session_start();
include '../includes/includes-config.php';
include '../includes/includes-functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: connexion.php');
    exit();
}

// Fetch user data
try {
    $user_id = $_SESSION['user_id'];
    
    // Fetch user information
    $user = getUserById($conn, $user_id);
    
    // Fetch user events
    $user_events = getUserEvents($conn, $user_id);
    
    // Fetch user clubs
    $user_clubs = getUserClubs($conn, $user_id);
    
    // Debug: Check if user data is fetched
    if (!$user) {
        die("Utilisateur non trouvé.");
    }
} catch (PDOException $e) {
    // Handle database errors
    die("Erreur de base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte - Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Reset Styles */
    

        .account-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .account-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5em;
            color: #444;
            margin-bottom: 15px;
        }

        .user-profile, .user-events, .user-clubs {
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            font-size: 1.1em;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .event-list, .club-list {
            list-style: none;
            padding: 0;
        }

        .event-item, .club-item {
            background: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .event-item:hover, .club-item:hover {
            background-color: #e0e0e0;
        }

        .empty-message {
            color: #888;
            font-style: italic;
        }

        .event-details, .club-details {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
            background-color: #f9f9f9;
            display: none;
        }

        .details-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        
       
      
        
    </style>
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>
    <main class="account-container"style="margin-top: 200px;">  
        <section class="account-section">
            <h1 class="account-title"style="font-size: 34px";>Mon compte</h1>
            <div class="user-profile">
                <h2 class="section-title">Informations personnelles</h2>
                <p class="user-info"><strong>Nom:</strong> <span class="user-name"><?php echo htmlspecialchars($user['name'] ?? 'N/A'); ?></span></p>
                <p class="user-info"><strong>Email:</strong> <span class="user-email"><?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></span></p>
                <button class="btn edit-profile-btn">Modifier le profil</button>
            </div>

            <div class="user-events">
                <h2 class="section-title">Mes événements</h2>
                <ul class="event-list">
                    <?php if (!empty($user_events)): ?>
                        <?php foreach ($user_events as $event): ?>
                            <li class="event-item" onclick="showEventDetails(<?php echo $event['id']; ?>)">
                                <?php echo htmlspecialchars($event['name']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="empty-message">Aucun événement inscrit</li>
                    <?php endif; ?>
                </ul>
                <div class="event-details" id="event-details">
                    <h3 class="details-title">Détails de l'événement</h3>
                    <p class="event-description" id="event-description"></p>
                </div>
            </div>

            <div class="user-clubs">
                <h2 class="section-title">Mes clubs</h2>
                <ul class="club-list">
                    <?php if (!empty($user_clubs)): ?>
                        <?php foreach ($user_clubs as $club): ?>
                            <li class="club-item" onclick="showClubDetails(<?php echo $club['id']; ?>)">
                                <?php echo htmlspecialchars($club['name']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="empty-message">Aucun club inscrit</li>
                    <?php endif; ?>
                </ul>
                <div class="club-details" id="club-details">
                    <h3 class="details-title">Détails du club</h3>
                    <p class="club-description" id="club-description"></p>
                </div>
            </div>
        </section>
    </main>
    <?php include '../includes/includes-footer.php'; ?>
    <script>
        function showEventDetails(eventId) {
            // Logic to show event details
            document.getElementById("event-details").style.display = "block";
            document.getElementById("event-description").textContent = "Détails pour l'événement " + eventId;
        }

        function showClubDetails(clubId) {
            // Logic to show club details
            document.getElementById("club-details").style.display = "block";
            document.getElementById("club-description").textContent = "Détails pour le club " + clubId;
        }
    </script>