<?php
require_once 'dp.php.inc';
session_start(); //start the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    if (isset($_POST['team_member_id']) && isset($_POST['role'])) {
        $role = $_POST['role'];
        $teamMemberID = $_POST['team_member_id'];
        $taskID = $_POST['task_id'];
        $contribution = $_POST['contribution'];

        $sqlerror = "select * from tasks_team_members where task_id = :taskID and member_id = :memberID ";
        $stmterr = $pdo->prepare($sqlerror);
        $stmterr->bindValue(":memberID", $teamMemberID);
        $stmterr->bindValue(":taskID", $taskID);
        $stmterr->execute();
        $row = $stmterr->fetch(PDO::FETCH_ASSOC);

        $sql2 = "select * from users where user_id=:userID";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindValue(":userID", $teamMemberID);
        $stmt2->execute();
        $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($row) { // if the same member assigned to this task show error msg
            $_SESSION['errmessage'] = "Team member with name {$user2['name']} already assigned to Task with $taskID";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        // Calculate total contribution for the task
        $sqlCont = "SELECT SUM(contribution) AS total_contribution FROM tasks_team_members WHERE task_id = :taskID";
        $stmtCont = $pdo->prepare($sqlCont);
        $stmtCont->bindValue(":taskID", $taskID);
        $stmtCont->execute();
        $result = $stmtCont->fetch();
        $totalContribution = $result['contribution'] ?? 0; // if its not a set make its value = 0 

        // check if adding the new contribution exceeds 100%
        if (($totalContribution + $contribution) > 100) {
            $_SESSION['errmessage'] = "Total contribution for Task ID ($taskID) cannot exceed 100%. Current contribution is $totalContribution%.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $sql = "INSERT INTO tasks_team_members (task_id, member_id, contribution, role) 
                VALUES (:taskID, :memberID, :contribution, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":role", $role);
        $stmt->bindValue(":memberID", $teamMemberID);
        $stmt->bindValue(":taskID", $taskID);
        $stmt->bindValue(":contribution", $contribution);
        $stmt->execute();
        $_SESSION['message'] = "Team member with name ({$user2['name']}) successfully assigned to Task with ID ($taskID) as ($role).";
        header("Location: " . $_SERVER['HTTP_REFERER']); //redirect to the previous page
        exit();
    } else {
        echo "error";
    }
}
?>