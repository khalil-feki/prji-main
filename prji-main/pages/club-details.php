<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

if (isset($_GET['id'])) {
    $club_id = intval($_GET['id']);
    $stmt = $conn->prepare('SELECT * FROM clubs WHERE id = ?');
    $stmt->execute([$club_id]);
    $club = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($club) {
        echo json_encode(['description' => $club['description']]); // Adjust according to your database structure
    } else {
        echo json_encode(['description' => 'Club non trouvé.']);
    }
} else {
    echo json_encode(['description' => 'ID de club manquant.']);
}
?>
