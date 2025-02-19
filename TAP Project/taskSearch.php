<?php
require_once 'dp.php.inc';

$projects_sql = "SELECT * FROM projects";
$projects_stmt = $pdo->query($projects_sql);
$projects = $projects_stmt->fetchAll(PDO::FETCH_ASSOC);

$priority = isset($_POST['priority']) ? $_POST['priority'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$project_id = isset($_POST['project']) ? $_POST['project'] : '';

$where_clauses = [];

if ($_SESSION['role'] == 'Team Member') {
    $where_clauses[] = "tasks.task_id IN (
        SELECT task_id FROM tasks_team_members WHERE member_id = :user_id
    ) AND tasks.status = 'In Progress'";
} elseif ($_SESSION['role'] == 'Project Leader') {
    $where_clauses[] = "tasks.project_id IN (
        SELECT project_id FROM projects WHERE team_leader_id = :user_id
    )";
}

if ($priority) {
    $where_clauses[] = "tasks.priority = :priority";
}
if ($status) {
    $where_clauses[] = "tasks.status = :status";
}
if ($start_date && $end_date) {
    $where_clauses[] = "tasks.start_date >= :start_date AND tasks.end_date <= :end_date";
}
if ($project_id) {
    $where_clauses[] = "tasks.project_id = :project_id";
}

$where_sql = implode(" AND ", $where_clauses); // add and between conditions
if ($where_sql) {
    $where_sql = "WHERE " . $where_sql;
}

$sql = "SELECT tasks.*, projects.title 
        FROM tasks 
        LEFT JOIN projects ON tasks.project_id = projects.project_id 
        $where_sql 
        ORDER BY tasks.task_id ASC";

$stmt = $pdo->prepare($sql);

// Bind parameters
if ($_SESSION['role'] == 'Team Member' || $_SESSION['role'] == 'Project Leader') {
    $stmt->bindValue(':user_id', $_SESSION['user_id']);
}
if ($priority) {
    $stmt->bindValue(':priority', $priority);
}
if ($status) {
    $stmt->bindValue(':status', $status);
}
if ($start_date && $end_date) {
    $stmt->bindValue(':start_date', $start_date);
    $stmt->bindValue(':end_date', $end_date);
}
if ($project_id) {
    $stmt->bindValue(':project_id', $project_id);
}

$stmt->execute();
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment</title>
</head>

<body>
    <h1>Search for a Task</h1>

<form method="POST" action="">
    <fieldset>
    <legend>Search Filter</legend>
    <label for="priority">Priority:</label>
    <select name="priority" id="priority">
        <option value="">--Select--</option>
        <option value="Low" <?= $priority == 'Low' ? 'selected' : '' ?>>Low</option>
        <option value="Medium" <?= $priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
        <option value="High" <?= $priority == 'High' ? 'selected' : '' ?>>High</option>
    </select>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="">--Select--</option>
        <option value="Pending" <?= $status == 'Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="In Progress" <?= $status == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
        <option value="Completed" <?= $status == 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" value="<?= $start_date ?>">

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" value="<?= $end_date ?>">

    <label for="project">Project:</label>
    <select name="project" id="project">
        <option value="">--Select--</option>
        <?php foreach ($projects as $project): ?>
            <option value="<?= $project['project_id'] ?>" <?= $project_id == $project['project_id'] ? 'selected' : '' ?>>
                <?= $project['title'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Search</button>
    </fieldset>
</form>

<table id="tasks_table">
    <thead>
        <tr>
            <th>Task ID</th>
            <th>Title</th>
            <th>Project</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Completion %</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <?php
                // convert status to lowercase and if we have space replace it with - so we can reach it it in css class 
                $status_class = str_replace(' ', '-', strtolower($task['status']));
                $priority_class = $task['priority'];
                ?>
                <tr class="<?= $priority_class ?> <?= $status_class ?>">
                <td>
                        <a href="task_details.php?task_id=<?= $task['task_id'] ?>">
                            <?= $task['task_id'] ?>
                        </a>
                    </td>
                    <td><?= $task['task_name'] ?></td>
                    <td><?= $task['project_name'] ?></td>
                    <td class="<?= $status_class ?>"><?=$task['status'] ?></td>
                    <td class="<?= $priority_class ?>"><?= $task['priority'] ?></td>
                    <td><?= $task['start_date'] ?></td>
                    <td><?= $task['end_date'] ?></td>
                    <td><?= $task['progress'] ?>%</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No tasks found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</body>
</html>
