<?php
session_start();
include("dp.php.inc");
// Check if the session contains the user_id
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: signIn.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Allocator Pro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <header>
        <div class="header-container">
            <h1>Task Allocator Pro </h1>
            <div class="right-links">
                <a href="profile.php" class="auth-link">
                    <?php echo $_SESSION['role'] . " : ", $_SESSION['name']; ?>
                </a>
                <a href="logout.php" class="auth-link">Logout</a>
                <a href="signIn.php" class="auth-link">Login</a>
                <a href="signUp.php" class="auth-link">Sign Up</a>
            </div>
        </div>
    </header>

    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $current_id = $_GET['id'];// Get the current 'id' parameter from the URL
        } else {
            $current_id = '';
        }
        ?>
        <aside>
            <nav> <!-- determine which navs will appear accoring to the user role  -->
                <a href="?id=task_details" class="<?= $current_id === 'task_details' ? 'active' : '' ?>">Task Details
                    Page</a>
                <a href="?id=task_search" class="<?= $current_id === 'task_search' ? 'active' : '' ?>">Task Search
                    Functionality</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Manager') { ?>
                    <a href="?id=add_project" class="<?= $current_id === 'add_project' ? 'active' : '' ?>">Add Project</a>
                    <a href="?id=Allocate_Team_Leader_to_Project"
                        class="<?= $current_id === 'Allocate_Team_Leader_to_Project' ? 'active' : '' ?>">Allocate Team
                        Leader to Project</a>
                <?php } ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Project Leader') { ?>
                    <a href="?id=task_creation" class="<?= $current_id === 'task_creation' ? 'active' : '' ?>">Task
                        Creation</a>
                    <a href="?id=task_assignment" class="<?= $current_id === 'task_assignment' ? 'active' : '' ?>">Assign
                        Team Members to Tasks</a>
                <?php } ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Team Member') { ?>
                    <?php
                    $sql = "SELECT task_id FROM tasks_team_members WHERE member_id =:userID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":userID", $_SESSION['user_id']);
                    $stmt->execute();
                    $tasks = $stmt->fetchAll();
                    $classValue = '';
                    if (count($tasks) > 0) {
                        foreach ($tasks as $row) {
                            $taskID = $row['task_id'];
                            $sql = "SELECT task_id, task_name, start_date, project_id FROM tasks WHERE task_id = :taskID and status='Pending' ";
                            $stmtTask = $pdo->prepare($sql);
                            $stmtTask->bindValue(":taskID", $taskID);
                            $stmtTask->execute();
                            $task = $stmtTask->fetch();
                            if ($task) {  // If the team member exists, add 'hasTasks' to the class
                                $classValue = 'hasTasks';
                            }
                        }
                    } else {
                        $classValue = 'hasTasks';
                    }
                    ?>
                    <a href="?id=accept_task"
                        class="<?= isset($current_id) && $current_id === 'accept_task' ? 'active' : '' ?> <?= $classValue ?>">
                        Accept Task Assignments
                    </a>
                    <a href="?id=search_update_task_progress"
                        class="<?= isset($current_id) && $current_id === 'search_update_task_progress' ? 'active' : '' ?>">
                        Search and Update Task Progress
                    </a>

                <?php } ?>

            </nav>
        </aside>

        <main>
            <section>

                <article>
                    <?php
                    // check the 'id' parameter in the query string
                    if ($current_id === 'task_assignment') {
                        
                        include 'task_assignment.php';
                    }
                    if ($current_id === 'task_search') {
                        include 'taskSearch.php';
                    }

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        switch ($id) {
                            case 'add_project':
                                include 'addProjectForm.php'; // Include the form HTML from a separate file
                                break;
                            case 'Allocate_Team_Leader_to_Project':
                                try {
                                    // get projects that didnot allocated to a team leader yet
                                    $stmt = $pdo->query("SELECT project_id, title, start_date, end_date FROM projects WHERE team_leader_id IS NULL ORDER BY start_date ASC");
                                    // echo the table to show data 
                                    echo "<table>";
                                    echo "<tr>
                                      <th>Project ID</th>
                                      <th>Project Title</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Action</th>
                                      </tr>";
                                    echo "<tbody>";
                                    // add projects to the table
                                    while ($row = $stmt->fetch()) {
                                        echo "<tr>
                                             <td>{$row['project_id']}</td>
                                            <td>{$row['title']}</td>
                                            <td>{$row['start_date']}</td>
                                            <td>{$row['end_date']}</td>
                                            <td><a href='?id=allocateTeamLeaderToProject&project_id={$row['project_id']}'>Allocate Team Leader</a></td>
                                            </tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                break;
                            case 'allocateTeamLeaderToProject':
                                try {
                                    if (isset($_GET["project_id"])) {
                                        $projectId = $_GET['project_id'];
                                        $sql = "SELECT * FROM projects WHERE project_id = :id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindValue(":id", $projectId);
                                        $stmt->execute();
                                        $project = $stmt->fetch();

                                        // Get team leaders from database
                                        $stmt2 = $pdo->query("SELECT * FROM users where role ='Project Leader'");
                                        $leaders = $stmt2->fetchAll();
                                    } else {
                                        echo "No project selected.";
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }

                                ?>
                                <?php if (isset($_SESSION['successmsg'])): // show msgs for action results?>
                                    <p class="successmsg">
                                        <?php
                                        echo $_SESSION['successmsg'];
                                        unset($_SESSION['successmsg']); // Clear message after displaying
                                        ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['errormsg'])): ?>
                                    <p class="errormsg">
                                        <?php
                                        echo $_SESSION['errormsg'];
                                        unset($_SESSION['errormsg']); // Clear message after displaying
                                        ?>
                                    </p>
                                <?php endif; ?>

                                <form action="saveAllocation.php" method="post" class="allocation-form">
                                    <fieldset>
                                        <legend>Project Details</legend>
                                        <label>Project ID:</label>
                                        <input type="text" value="<?php echo $project['project_id']; ?>" disabled>
                                        <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                                        <!-- use it to get value of project ID from form ($_POST['project_id']) -->

                                        <label>Title:</label>
                                        <input type="text" value="<?php echo $project['title']; ?>" disabled>

                                        <label>Description:</label>
                                        <textarea disabled><?php echo $project['description']; ?></textarea>

                                        <label>Customer Name:</label>
                                        <input type="text" value="<?php echo $project['customer_name']; ?>" disabled>

                                        <label>Budget:</label>
                                        <input type="text" value="<?php echo $project['budget']; ?>" disabled>

                                        <label>Start Date:</label>
                                        <input type="text" value="<?php echo $project['start_date']; ?>" disabled>

                                        <label>End Date:</label>
                                        <input type="text" value="<?php echo $project['end_date']; ?>" disabled>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Select Team Leader</legend>
                                        <label>Team Leader:</label>
                                        <select name="team_leader_id" required>
                                            <option value="" disabled selected>Select a Team Leader</option>
                                            <?php
                                            for ($i = 0; $i < count($leaders); $i++) {
                                                $leader = $leaders[$i];
                                                echo "<option value='{$leader['user_id']}'>{$leader['name']} - {$leader['user_id']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <button type="submit">Confirm Allocation</button>
                                </form>
                                <?php
                                break;
                            case "task_creation":
                                include 'taskCreationForm.php';
                                break;
                            case 'accept_task':
                                $sql = "SELECT task_id FROM tasks_team_members WHERE member_id =:userID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(":userID", $_SESSION['user_id']);
                                $stmt->execute();
                                $tasks = $stmt->fetchAll();

                                ?>

                                <?php if (isset($_SESSION['successmsg'])): ?>
                                    <p class="successmsg">
                                        <?php
                                        echo $_SESSION['successmsg'];
                                        unset($_SESSION['successmsg']); // Clear message after displaying
                                        ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['errormsg'])): ?>
                                    <p class="errormsg">
                                        <?php
                                        echo $_SESSION['errormsg'];
                                        unset($_SESSION['errormsg']); // Clear message after displaying
                                        ?>
                                    </p>
                                <?php endif; ?>
                                <?php
                                echo "<h1 class = 'boldandcentered'>Assigned Tasks</h1>";
                                echo "<table class ='evenrows'>"; // make even rows be light gray
                                echo "<thead>
                                <tr>
                                <th>Task ID</th>
                                <th>Task Name</th>
                                <th>Start Date</th>
                                <th>Project Name</th>
                                <th>Confirm</th>
                                </tr>
                                </thead>";
                                echo "<tbody>";

                                if (count($tasks) > 0) {
                                    foreach ($tasks as $row) {
                                        $taskID = $row['task_id'];
                                        $sql = "SELECT task_id, task_name, start_date, project_id FROM tasks WHERE task_id = :taskID and status='Pending' ";
                                        $stmtTask = $pdo->prepare($sql);
                                        $stmtTask->bindValue(":taskID", $taskID);
                                        $stmtTask->execute();
                                        $task = $stmtTask->fetch();
                                        if ($task) {
                                            $sql2 = "SELECT title FROM projects WHERE project_id = :projID";
                                            $stmtProj = $pdo->prepare($sql2);
                                            $stmtProj->bindValue(":projID", $task['project_id']);
                                            $stmtProj->execute();
                                            $project = $stmtProj->fetch();
                                            echo "<tr>
                                        <td>{$task['task_id']}</td>
                                        <td>{$task['task_name']}</td>
                                        <td>{$task['start_date']}</td>
                                        <td>{$project['title']}</td>
                                        <td><a href='?id=confirmTask&task_id={$task['task_id']}'>confirm</a></td>
                                        </tr>";
                                        } else if (!$task && count($tasks) == 1) {
                                            echo "<tr>
                                            <td colspan='5'>There are no new tasks assigned to you.</td>
                                            </tr>";
                                        }
                                    }
                                } else {
                                    echo "<tr>
                                    <td colspan='5'>There are no new tasks assigned to you.</td>
                                    </tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                break;
                            case "confirmTask":
                                $sql = "SELECT * FROM tasks_team_members WHERE task_id =:taskID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(":taskID", $_GET['task_id']);
                                $stmt->execute();
                                $taskToMember = $stmt->fetch();

                                $sql = "SELECT * FROM tasks WHERE task_id =:taskID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(":taskID", $_GET['task_id']);
                                $stmt->execute();
                                $task = $stmt->fetch();

                                ?>

                                <form method="post" action="acceptOrRejectTask.php" class="taskActionForm">
                                    <fieldset>
                                        <legend>Accept Task or reject</legend>
                                        <label>Task ID:</label>
                                        <input type="text" name="task_id" value="<?php echo $task['task_id']; ?>" readonly><br>

                                        <label>Task Title:</label>
                                        <input type="text" name="taskname" value="<?php echo $task['task_name']; ?>" readonly><br>

                                        <label>Task Description:</label>
                                        <textarea readonly><?php echo $task['description']; ?></textarea><br>

                                        <label>Priority:</label>
                                        <input type="text" value="<?php echo $task['priority']; ?>" readonly><br>

                                        <label>Status:</label>
                                        <input type="text" value="<?php echo $task['status']; ?>" readonly><br>

                                        <label>Total Effort:</label>
                                        <input type="text" value="<?php echo $task['effort']; ?>" readonly><br>

                                        <label>Role:</label>
                                        <input type="text" value="<?php echo $taskToMember['role']; ?>" readonly><br>

                                        <label>Start Date:</label>
                                        <input type="text" value="<?php echo $task['start_date']; ?>" readonly><br>

                                        <label>End Date:</label>
                                        <input type="text" value="<?php echo $task['end_date']; ?>" readonly><br>
                                    </fieldset>
                                    <button type="submit" name="action" value="accept">Accept Task</button>
                                    <button type="submit" name="action" value="reject" class="reject">Reject Task</button>

                                </form>
                                <?php
                                break;
                            case 'search_update_task_progress':
                                $search = isset($_POST['search']) ? $_POST['search'] : '';
                                $search_param = "%$search%";
                                try {
                                    $sql = "SELECT t.* 
                                    FROM tasks t 
                                    INNER JOIN tasks_team_members ttm ON t.task_id = ttm.task_id 
                                    WHERE (t.task_id LIKE :search OR t.task_name LIKE :search OR t.project_name LIKE :search) 
                                    AND t.status = 'In Progress'";                                    
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindValue(':search', $search_param);
                                    $stmt->execute();
                                    $tasks = $stmt->fetchAll();
                                } catch (PDOException $e) {
                                    echo '' . $e->getMessage();
                                }
                                ?>
                                <h1>Task Management</h1>
                       
                                <?php if (isset($_SESSION['successmsg'])): ?>
                            <p class="successmsg">
                                <?php
                                echo $_SESSION['successmsg'];
                                unset($_SESSION['successmsg']); // Clear message after displaying
                                ?>
                            </p>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['errormsg'])): ?>
                            <p class="errormsg">
                                <?php
                                echo $_SESSION['errormsg'];
                                unset($_SESSION['errormsg']); // Clear message after displaying
                                ?>
                            </p>
                        <?php endif; ?>

                                <form method="POST" action="">
                                    <fieldset>
                                        <legend>Search Tasks:</legend>
                                        <input type="text" name="search" id="search"
                                            placeholder="Enter Task ID, Task Name, or Project Name" required>
                                        <br><br>
                                        <button type="submit">Search</button>
                                    </fieldset>
                                </form>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Task ID</th>
                                            <th>Task Name</th>
                                            <th>Project Name</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($tasks): ?>
                                            <?php foreach ($tasks as $task): ?>
                                                <tr>
                                                    <td><?= $task['task_id'] ?></td>
                                                    <td><?= $task['task_name'] ?></td>
                                                    <td><?= $task['project_name'] ?></td>
                                                    <td><?= $task['progress'] ?>%</td>
                                                    <td><?= $task['status'] ?></td>
                                                    <td> <a
                                                            href="dashboard.php?id=search_update_task_progress&task_id=<?= $task['task_id'] ?>">Update</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6">No tasks found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php if (isset($_GET['task_id'])): ?>
                                    <?php if (isset($_GET['task_id'])): ?>
                                        <?php
                                        // get task details using the task_id from get method
                                        $task_id = $_GET['task_id'];
                                        $sql = "SELECT * FROM tasks WHERE task_id = :task_id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindValue(':task_id', $task_id);
                                        $stmt->execute();
                                        $task = $stmt->fetch(PDO::FETCH_ASSOC);

                                        // get contribution value 
                                        $task_id = $task['task_id'];
                                        $sql = "SELECT contribution 
                                        FROM tasks_team_members 
                                        WHERE task_id = :task_id AND member_id = :member_id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindValue(':task_id', $task_id);
                                        $stmt->bindValue(':member_id', $_SESSION['user_id']);
                                        $stmt->execute();
                                        $contribution = $stmt->fetchColumn();

                                        // Set max to the contribution value, default to 100 if there is no value
                                        $max_progress = $contribution ? $contribution : 100;
                                        ?>
                                    <?php endif; ?>

                                    <div class="form-container">
                                        <form method="POST" action="update_task.php">
                                            <h2>Update Task</h2>
                                            <div class="form-group">
                                                <label for="task_id">Task ID</label>
                                                <input type="text" name="task_id" id="task_id" value="<?= $task['task_id'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="task_name">Task Name</label>
                                                <input type="text" name="task_name" id="task_name" value="<?= $task['task_name'] ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="project_name">Project Name</label>
                                                <input type="text" name="project_name" id="project_name"
                                                    value="<?= $task['project_name'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="progress">Progress (%)</label>
                                                <input type="number" name="progress" id="progress" min="0" max=<?= $max_progress ?>
                                                    value="<?= $task['progress'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" required>
                                                    <option value="Pending" disabled<?= $task['status'] === 'Pending' ? 'selected' : '' ?>>Pending
                                                    </option>
                                                    <option value="In Progress" <?= $task['status'] === 'In Progress' ? 'selected' : '' ?>>
                                                        In Progress</option>
                                                    <option value="Completed" disabled<?= $task['status'] === 'Completed' ? 'selected' : '' ?>>
                                                        Completed</option>
                                                </select>
                                            </div>
                                            <button type="submit">Save Changes</button>
                                            <a href="tasks.php">Cancel</a>
                                        </form>
                                    </div>
                                <?php endif; ?>
                                <?php
                                break;

                            default:
                                break;
                        }
                    }

                    ?>

                </article>
            </section>
        </main>
    </div>

    <footer>
        <section>
            <p>&copy; 2024 Task Allocator Pro. All rights reserved.</p>
            <p>Contact: support@taskallocatorpro.com</p>

        </section>
    </footer>
</body>

</html>