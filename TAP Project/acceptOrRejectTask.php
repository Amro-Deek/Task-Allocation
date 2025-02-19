<?php

require_once 'dp.php.inc'; // include data base connection
session_start(); // start the session
// get data from session ad post method
$task_id = $_POST['task_id'];
$member_id = $_SESSION['user_id'];
$action = $_POST['action'];

if ($action == 'accept') { //if accept button is clicked 
    $sql = "UPDATE tasks SET status = 'In Progress' WHERE task_id = :taskID ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":taskID", $task_id); // binding value
    $stmt->execute();

    $_SESSION['successmsg'] = "Task successfully accepted and activated.";
    $url = "dashboard.php?id=accept_task";
    header("Location: " . $url);
    exit();
} elseif ($action == 'reject') {//if reject button is clicked 
    $sql = "DELETE FROM tasks_team_members WHERE task_id = :taskID AND member_id = :memberID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":taskID", $task_id);// binding value
    $stmt->bindValue(":memberID", $member_id);// binding value
    $stmt->execute();
    $_SESSION['errormsg'] = "Task assignment successfully rejected.";
    $url = "dashboard.php?id=accept_task";
    header("Location: " . $url); // redirect to the dashboard 
    exit();

} else {
    echo "Invalid action.";
}
?>