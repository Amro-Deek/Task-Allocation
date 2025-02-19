<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Creation Form</title>
    <link rel="stylesheet"  href="ex.css"> 
</head>
<body>
    <?php
    require_once 'dp.php.inc';

    $leaderID = $_SESSION['user_id'];
    $sql = "SELECT project_id, title FROM projects WHERE team_leader_id = :leader_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':leader_id', $leaderID);
    $stmt->execute();
    $projects = $stmt->fetchAll();

    $errorMessage = '';
    $task_name = $description = $project_id = $start_date = $end_date = $effort = $status = $priority = ''; // to save entered data if an error occures 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $task_name = $_POST['task_name'] ?? '';
        $description = $_POST['description'] ?? '';
        $project_id = $_POST['project_id'] ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $end_date = $_POST['end_date'] ?? '';
        $effort = $_POST['effort'] ?? '';
        $status = $_POST['status'] ?? '';
        $priority = $_POST['priority'] ?? '';

        // get project dates to validate
        $sql1 = "SELECT start_date, end_date FROM projects WHERE project_id = :project_id";
        $stmt = $pdo->prepare($sql1);
        $stmt->bindValue(':project_id', $project_id);
        $stmt->execute();
        $project = $stmt->fetch();

        $sql2 = 'select * from tasks where task_name = :taskname';
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindValue('taskname', $task_name);
        $stmt2->execute();
        $task = $stmt2->fetch();

        // Validation
        if (empty($task_name) || empty($description) || empty($project_id) || empty($start_date) || empty($end_date) || empty($effort) || empty($priority)) {
            $errorMessage = 'All fields are required.';
        }
        
        else if ($task){
            $errorMessage = "Task with name ($task_name) Already exists!";
        }
        elseif ($start_date < $project['start_date']) {
            $errorMessage = 'Start Date cannot be earlier than the Project Start Date.';
        } elseif ($end_date > $project['end_date']) {
            $errorMessage = 'End Date cannot exceed the Project End Date.';
        } elseif ($start_date > $end_date) {
            $errorMessage = 'Start Date cannot be later than the End Date.';
        }
        
        
        // If no errors, insert data
        if (!$errorMessage) {
            
            $sql = "INSERT INTO tasks (task_name, description, project_id, start_date, end_date, effort, status, priority)
                    VALUES (:task_name, :description, :project_id, :start_date, :end_date, :effort, :status, :priority)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":task_name", $task_name);
            $stmt->bindValue(":description", $description);
            $stmt->bindValue(":project_id", $project_id);
            $stmt->bindValue(":start_date", $start_date);
            $stmt->bindValue(":end_date", $end_date);
            $stmt->bindValue(":effort", $effort);
            $stmt->bindValue(":status", $status);// status will be dafualt Pending (disable another status bkuz we change it later)
            $stmt->bindValue(":priority", $priority);

            $stmt->execute();

            echo "<p class = 'success'>Task '{$task_name}' successfully created.</p>";
        }
    }
    ?>
<?php if (!empty($errorMessage)): ?>
        <p class="errormsg"><?=$errorMessage?></p>
    <?php endif; ?>
    <form id="taskCreationForm" action="" method="POST">
        <fieldset>
            <legend>Task Details</legend>

            <label for="taskName">Task Name:</label>
            <input type="text" id="taskName" name="task_name" value="<?= $task_name ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= $description ?></textarea>
<br><br>
            <label for="project">Project:</label>
            <select id="project" name="project_id" required>
                <option value="">Select a Project</option>
                <?php for ($i = 0; $i < count($projects); $i++): ?>
                <option value="<?= $projects[$i]['project_id'] ?>" <?= (isset($_POST['project_id']) && $_POST['project_id'] == $projects[$i]['project_id']) ? 'selected' : '' ?>>
                    <?= $projects[$i]['title'] ?>
                </option>
            <?php endfor; ?>
            </select>
            <br><br>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="start_date" value="<?=$start_date?>" required>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="end_date" value="<?=$end_date ?>" required>

            <label for="effort">Effort (man-months):</label>
            <input type="number" id="effort" name="effort" value="<?= $effort?>" step="0.1" min="0.1" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Pending" selected<?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="In Progress" disabled<?= $status == 'In Progress' ? 'selected' : '' ?>>In Progress</option> 
                <option value="Completed" disabled<?= $status == 'Completed' ? 'selected' : '' ?>>Completed</option>
            </select>

            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="Low" <?= $priority == 'Low' ? 'selected' : '' ?>>Low</option>
                <option value="Medium" <?= $priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
                <option value="High" <?= $priority == 'High' ? 'selected' : '' ?>>High</option>
            </select>
        </fieldset>

        <button type="submit">Create Task</button>
    </form>
</body>
</html>
