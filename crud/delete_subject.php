<?php
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
parse_str(file_get_contents("php://input"), $deleteData);

if (!isset($deleteData['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Subject ID is required']);
    exit;
}

$id = filter_var($deleteData['id'], FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount()) {
        http_response_code(200);
        echo json_encode(['message' => 'Subject deleted successfully']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Subject not found']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Delete failed - subject may be referenced in grades']);
}
?>