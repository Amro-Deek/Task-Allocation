<?php
require_once 'dp.php.inc';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['task_name']) &&
        isset($_POST['description']) &&
        isset($_POST['project_id']) &&
        isset($_POST['start_date']) &&
        isset($_POST['end_date']) &&
        isset($_POST['effort']) &&
        isset($_POST['status']) &&
        isset($_POST['priority'])
    ) {
        $task_name = $_POST['task_name'];
        $description = $_POST['description'];
        $project_id = $_POST['project_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $effort = $_POST['effort'];
        $status = $_POST['status'];
        $priority = $_POST['priority'];

        // get prj start and end date to check and validate
        $sql1 = "SELECT start_date, end_date FROM projects WHERE project_id = :project_id";
        $stmt = $pdo->prepare($sql1);
        $stmt->bindValue(':project_id', $project_id);
        $stmt->execute();
        $project = $stmt->fetch();

        // Validation
        if (empty($task_name) || empty($description) || empty($project_id) || empty($start_date) || empty($end_date) || empty($effort) || empty($priority)) {
            $errorMessage = 'All fields are required.';
        } elseif ($start_date < $project['start_date']) {
            $errorMessage = 'Start Date cannot be earlier than the Project Start Date.';
        } elseif ($end_date > $project['end_date']) {
            $errorMessage = 'End Date cannot exceed the Project End Date.';
        } elseif ($start_date > $end_date) {
            $errorMessage = 'Start Date cannot be later than the End Date.';
        }

        // insert to the database there is no errors 
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
            $stmt->bindValue(":status", $status);
            $stmt->bindValue(":priority", $priority);

            $stmt->execute();

            echo "<p>Task '{$task_name}' successfully created.</p>";
        }
    }
}
?>

<?php if ($errorMessage): ?>
    <p class="errormsg"><?= $errorMessage ?></p>
<?php endif; ?>
?>