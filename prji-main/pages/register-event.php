<?php
session_start();
require_once '../includes/includes-config.php';
require_once '../includes/includes-functions.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté.']);
    exit;
}

// Check if event_id is provided
if (!isset($_POST['event_id']) || !is_numeric($_POST['event_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID d\'événement invalide.']);
    exit;
}

try {
    $user_id = $_SESSION['user_id'] ?? null;
    $event_id = intval($_POST['event_id']); // Ensure it's an integer

    // Debugging: Check if user_id and event_id are set
    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'ID utilisateur manquant.']);
        exit;
    }

    // Check if already registered
    $stmt = $conn->prepare('SELECT 1 FROM event_registrations WHERE user_id = ? AND event_id = ?');
    $stmt->execute([$user_id, $event_id]);

    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cet événement.']);
        exit;
    }

    // Insert into event_registrations table
    $stmt = $conn->prepare('INSERT INTO event_registrations (user_id, event_id) VALUES (?, ?)');
    $result = $stmt->execute([$user_id, $event_id]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Inscription réussie!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'inscription.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()]);
}
