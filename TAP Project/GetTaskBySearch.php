<?php
require_once "dp.php.inc";
$task_id = isset($_GET['task_id']) ? $_GET['task_id'] : '';
$sql = "SELECT * FROM tasks WHERE task_id = :task_id";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':task_id', $task_id, PDO::PARAM_STR);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>