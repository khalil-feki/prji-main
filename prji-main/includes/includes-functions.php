<?php
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function getUserById($conn, $user_id)
{
    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getClubs($conn)
{
    $stmt = $conn->query('SELECT * FROM clubs');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUpcomingEvents($conn) {
    try {
        $stmt = $conn->prepare("
            SELECT e.*, c.name as club_name 
            FROM events e 
            LEFT JOIN clubs c ON e.club_id = c.id 
            WHERE e.date >= CURDATE() 
            ORDER BY e.date ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}



function getUserEvents($conn, $user_id)
{
    $stmt = $conn->prepare('SELECT e.* FROM event_registrations er JOIN events e ON er.event_id = e.id WHERE er.user_id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function registerUser($conn, $name, $email, $password)
{
    $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
    return $stmt->execute([$name, $email, $password]);
}
function getUserClubs($conn, $user_id) {
    $stmt = $conn->prepare('
        SELECT clubs.id, clubs.name, clubs.description 
        FROM clubs
        JOIN club_members ON clubs.id = club_members.club_id
        WHERE club_members.user_id = ?
    ');
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
