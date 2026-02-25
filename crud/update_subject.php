<?php
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    parse_str(file_get_contents("php://input"), $data);

    $stmt = $pdo->prepare("UPDATE subjects SET name = ?, credit = ?, dept_id = ? WHERE id = ?");
    $stmt->execute([
        $data['name'],
        $data['credit'],
        $data['dept_id'],
        $data['id']
    ]);

    echo "Subject updated successfully.";

} else {
    echo "Only PUT method allowed.";
}
?>