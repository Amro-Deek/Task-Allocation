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
        <?php
        require_once 'dp.php.inc';
        if (isset($_GET['project']) && !empty($_GET['project'])) {
            $projectId = $_GET['project'];

            // get tasks for the selected project
            $sql = "SELECT * FROM Tasks WHERE project_id = :projID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":projID", $projectId);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($result) {
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['TaskID'] . "</td>";
                    echo "<td>" . $row['TaskName'] . "</td>";
                    echo "<td>" . $row['StartDate'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td>" . $row['Priority'] . "</td>";
                    echo "<td><a href='assign.php?task_id=" . $row['TaskID'] . "' class='button'>Assign Team Members</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No tasks available for this project</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Please select a project to view tasks</td></tr>";
        }
        ?>
    </tbody>
</table>