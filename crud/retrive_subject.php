<?php
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {

        $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $subject = $stmt->fetch();

        if ($subject) {
            echo json_encode($subject);
        } else {
            echo "Subject not found";
        }

    } else {
        $stmt = $pdo->query("SELECT * FROM subjects");
        $subjects = $stmt->fetchAll();

        echo json_encode($subjects);
    }

} else {
    echo "Only GET method allowed.";
}
?>