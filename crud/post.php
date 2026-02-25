<?php
require_once "db_connection.php";

if (!isset($_POST['user_id'])) {
    http_response_code(400); 
    echo json_encode(['error' => 'user_id is required']);
    exit;
}

$user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);

if (!$user_id) {
    http_response_code(400); 
    echo json_encode(['error' => 'Invalid user_id']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user) {
        http_response_code(200); 
        echo json_encode($user);
    } else {
        http_response_code(404); 
        echo json_encode(['error' => 'User not found']);
    }

} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['error' => 'Query failed']);
}
?>