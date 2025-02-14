<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $stmt = $conn->prepare('SELECT * FROM events WHERE id = ?');
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event) {
        echo json_encode(['description' => $event['description']]); // Adjust according to your database structure
    } else {
        echo json_encode(['description' => 'Événement non trouvé.']);
    }
} else {
    echo json_encode(['description' => 'ID d\'événement manquant.']);
}
?>
