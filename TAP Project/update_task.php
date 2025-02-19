<?php
require_once 'dp.php.inc';
session_start();
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $new_progress = intval($_POST['progress']);
    $status = $_POST['status'];

    if (!empty($task_id)) {
       
        $task_query = "SELECT progress FROM tasks WHERE task_id = :task_id";
        $stmt = $pdo->prepare($task_query);
        $stmt->bindValue(':task_id', $task_id);
        $stmt->execute();
        $task_result = $stmt->fetch();

        if ($task_result) {
            $current_task_progress = intval($task_result['progress']); //casting to integer
            $added_progress = $new_progress; // Use the progress from the form

            // Add the new progress to the existing progress value
            $updated_progress = $current_task_progress + $added_progress;

            // check if progress doesn't exceed 100%
            if ($updated_progress > 100) {
                $updated_progress = 100;
            }

            // update tasks_team_members table
            $team_query = "UPDATE tasks_team_members SET contribution = contribution - :added_progress WHERE task_id = :task_id and member_id= :user_id";
            $team_stmt = $pdo->prepare($team_query);
            $team_stmt->bindValue(':added_progress', $added_progress);
            $team_stmt->bindValue(':task_id', $task_id);
            $team_stmt->bindValue(':user_id', $_SESSION['user_id']);
            $team_stmt->execute();

            // if progress reaches 100%, change status to Completed
            $updated_status = ($updated_progress == 100) ? 'Completed' : $status;

            // update tasks table
            $update_task_query = "UPDATE tasks SET progress = :updated_progress, status = :updated_status WHERE task_id = :task_id";
            $update_task_stmt = $pdo->prepare($update_task_query);
            $update_task_stmt->bindValue(':updated_progress', $updated_progress, PDO::PARAM_INT);
            $update_task_stmt->bindValue(':updated_status', $updated_status, PDO::PARAM_STR);
            $update_task_stmt->bindValue(':task_id', $task_id, PDO::PARAM_STR);
            $update_task_stmt->execute();

            // success message
            if ($update_task_stmt->rowCount() > 0) {
                $_SESSION['successmsg'] = "Task updated successfully.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                //error msg
                $_SESSION['errmessage'] = "No changes were made.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            //error msg
            $_SESSION['errmessage'] = "Task not found.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        echo "Invalid task ID or progress.";
    }
} else {
    echo "Invalid request.";
}
?>
