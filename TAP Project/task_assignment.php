<?php
require_once 'dp.php.inc';
// get all projects
$sql = "SELECT * FROM projects";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tasks = [];
$selectedTask = null;
$teamMembers = [];
$roles = ['Developer', 'Designer', 'Tester', 'Analyst', 'Support']; // Predefined roles

// Get tasks only if a project is selected
if (isset($_GET['project']) && !empty($_GET['project'])) {
    $projectId = $_GET['project'];
    try {
        // get tasks for the selected project
        $sql = "SELECT * FROM tasks WHERE project_id = :projID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":projID", $projectId);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
    }
}

// get selected task details if a task is chosen for assignment
if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
    $taskId = $_GET['task_id'];
    try {
        $sql = "SELECT * FROM tasks WHERE task_id = :taskID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":taskID", $taskId);
        $stmt->execute();
        $selectedTask = $stmt->fetch(PDO::FETCH_ASSOC);

        // get team members from the users table
        $sql = "SELECT * FROM users where role='Team Member'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment</title>
</head>

<body>
    <h1>Assign Team Members to Tasks</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p class="successmsg">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']); // Clear message after displaying
            ?>
        </p>
    <?php endif; ?>
    <?php if (isset($_SESSION['errmessage'])): ?>
        <p class="errormsg">
            <?php 
                echo $_SESSION['errmessage'];
                unset($_SESSION['errmessage']); // Clear message after displaying
            ?>
        </p>
    <?php endif; ?>

    <form method="get" action="">
        <input type="hidden" name="id" value="task_assignment">
        <label for="project">Select Project:</label>
        <select name="project" id="project">
            <option value="" disabled selected>-- Select a Project --</option>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project['project_id'] ?>" <?= isset($_GET['project']) && $_GET['project'] == $project['project_id'] ? 'selected' : '' ?>>
                    <?= $project['title'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">View Tasks</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Task ID</th>
                <th>Task Name</th>
                <th>Start Date</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['task_id'] ?></td>
                        <td><?= $task['task_name'] ?></td>
                        <td><?= $task['start_date'] ?></td>
                        <td><?= $task['status'] ?></td>
                        <td><?= $task['priority'] ?></td>
                        <td>
                            <a href="?id=task_assignment&project=<?= $_GET['project'] ?>&task_id=<?= $task['task_id'] ?>">Assign Team Members</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No tasks available for the selected project.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($selectedTask): ?>
        <h3>Assign Team Members to Task: <?= $selectedTask['task_name'] ?></h3>
        <form method="post" action="assignTeamMembers.php">
            <fieldset>
                <legend>Task Details</legend>
                <label>Task ID:</label>
                <input type="text" value="<?= $selectedTask['task_id'] ?>" readonly>
                <input type="hidden" name="task_id" value="<?= $selectedTask['task_id'] ?>">

                <label>Task Name:</label>
                <input type="text" value="<?= $selectedTask['task_name'] ?>" readonly>

                <label>Start Date:</label>
                <input type="text" value="<?= $selectedTask['start_date'] ?>" readonly>

                <label>Allocation Date:</label>
                <input type="text" name="allocation_date" value="<?= date('Y-m-d') ?>" readonly>
            </fieldset>

            <fieldset>
                <legend>Team Allocation</legend>
                <label>Team Member:</label>
                <select name="team_member_id" required>
                    <option value="" disabled selected>-- Select a Team Member --</option>
                    <?php foreach ($teamMembers as $member): ?>
                        <option value="<?= $member['user_id'] ?>"><?= $member['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Role:</label>
                <select name="role" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role ?>"><?= $role ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Contribution Percentage:</label>
                <input type="number" name="contribution" min="1" max="100" required>
            </fieldset>

            <button type="submit">Save Assignment</button>
        </form>
    <?php endif; ?>
</body>
</html>