
<?php
include "dp.php.inc";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projID = $_POST["project_id"];
    $leaderID = $_POST["team_leader_id"];

    try {
        $sql0 = "select * from projects where project_id = :proj_id and team_leader_id = :team_leader_id";
        $stmt0 = $pdo->prepare($sql0);
        $stmt0->bindValue(":proj_id", $projID);
        $stmt0->bindValue(":team_leader_id", $leaderID);
        $stmt0->execute();
        $result0 = $stmt0->fetchAll();
        if (count($result0) > 0) {
            $_SESSION['errormsg']= "Team Leader already allocated to Project $projID !";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $sql = "UPDATE projects SET team_leader_id = :team_leader_id WHERE project_id = :proj_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":proj_id", $projID);
        $stmt->bindValue(":team_leader_id", $leaderID);
        $stmt->execute();
        
        $_SESSION['successmsg']= "Team Leader successfully allocated to Project $projID.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
