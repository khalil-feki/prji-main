<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

// Fetch upcoming events from the database
$db_events = getUpcomingEvents($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - Gestion des clubs universitaires</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/includes-header.php'; ?>
    
    <main>
        <div class="evenements-top">
            <h1>Événements à venir</h1>
            
            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" id="search" placeholder="Rechercher des événements..." onkeyup="filterEvents()">
            </div>

            <!-- Categories -->
            <div class="event-categories">
                <button class="category-btn" onclick="filterByCategory('all')">Tous</button>
                <button class="category-btn" onclick="filterByCategory('theatre')">Théâtre</button>
                <button class="category-btn" onclick="filterByCategory('sport')">Sport</button>
                <button class="category-btn" onclick="filterByCategory('musique')">Musique</button>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM events ORDER BY date ASC";
        $stmt = $conn->query($sql);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($events):
        ?>
        <div class="evenements">
            <?php
            foreach ($events as $event):
                $eventCategory = $event['category'];
                $eventName = $event['name'];
                $eventDate = date('d F Y', strtotime($event['date']));
                $clubId = $event['club_id'];
                $eventId = $event['id'];
                
                // Define image mapping with correct relative paths
                $categoryImages = [
                    'theatre' => '../assets/image/imagestheatreevent.jpg',
                    'sport' => '../assets/image/imagesbasketball.jpg',
                    'musique' => '../assets/image/imagesconcert.jpg'
                ];
                
                $imagePath = isset($categoryImages[strtolower($eventCategory)]) 
                    ? $categoryImages[strtolower($eventCategory)] 
                    : '../assets/image/imagesevenements.png';
            ?>
            
            <div class="evenement" data-category="<?= htmlspecialchars($eventCategory) ?>">
                <img src="<?= $imagePath ?>" 
                     alt="<?= htmlspecialchars($eventName) ?>"
                     onerror="this.src='../assets/image/imagesevenements.png';">
                
                <h3><?= htmlspecialchars($eventName) ?></h3>
                <p>Date: <?= $eventDate ?></p>
                <p>Organisé par le club de <?= ucfirst($eventCategory) ?></p>
                
                <a href="#" class="btn" onclick="registerEvent(<?= $eventId ?>)">S'inscrire</a>
            </div>
            
            <?php endforeach; ?>
        </div>
        <?php
        else:
            echo "Aucun événement trouvé.";
        endif;
        ?>

        <!-- Dynamically fetched events section -->
        <?php
        $is_logged_in = isLoggedIn();

        foreach ($db_events as $event) {
            echo '<div class="evenement" data-category="' . htmlspecialchars($event['category']) . '">';
            
            // Use the same category image mapping
            $categoryImages = [
                'theatre' => '../assets/image/imagestheatreevent.jpg',
                'sport' => '../assets/image/imagesbasketball.jpg',
                'musique' => '../assets/image/imagesconcert.jpg'
            ];
            
            $imagePath = isset($categoryImages[strtolower($event['category'])]) 
                ? $categoryImages[strtolower($event['category'])] 
                : '../assets/image/imagesevenements.png';
            
            echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($event['name']) . '">';
            
            echo '<h3>' . htmlspecialchars($event['name']) . '</h3>';
            echo '<p>Date: ' . htmlspecialchars($event['date']) . '</p>';
            echo '<p>Organisé par: ' . htmlspecialchars($event['club_name']) . '</p>';
            
            if ($is_logged_in) {
                echo '<a href="#" class="btn" onclick="registerEvent(' . $event['id'] . ')">S\'inscrire</a>';
            } else {
                echo '<a href="connexion.php" class="btn">Connectez-vous pour vous inscrire</a>';
            }
            
            echo '</div>';
        }
        ?>
    </main>

    <?php include '../includes/includes-footer.php'; ?>

    <script>
    function filterEvents() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const events = document.querySelectorAll('.evenement');

        events.forEach(event => {
            const eventName = event.querySelector('h3').innerText.toLowerCase();
            if (eventName.includes(searchInput)) {
                event.style.display = '';
            } else {
                event.style.display = 'none';
            }
        });
    }

    function filterByCategory(category) {
        const events = document.querySelectorAll('.evenement');

        events.forEach(event => {
            if (category === 'all' || event.getAttribute('data-category') === category) {
                event.style.display = '';
            } else {
                event.style.display = 'none';
            }
        });
    }

    function registerEvent(eventId) {
        if (!confirm('Voulez-vous vraiment vous inscrire à cet événement ?')) {
            return;
        }

        const formData = new FormData();
        formData.append('event_id', eventId);

        fetch('register-event.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de l\'inscription.');
        });
    }
    </script>
</body>
</html>