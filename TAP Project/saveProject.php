<?php
session_start(); 

require_once 'dp.php.inc';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $projectID = $_POST['projectID'] ?? '';
    $title = $_POST['projectTitle'] ?? '';
    $description = $_POST['projectDescription'] ?? '';
    $customerName = $_POST['customerName'] ?? '';
    $budget = $_POST['totalBudget'] ?? '';
    $startDate = $_POST['startDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';
    $docTitles = $_POST['docTitles'] ?? [];
    $fileErrors = [];
    $_SESSION['form_data'] = $_POST;

    // Validate date
    if (strtotime($endDate) <= strtotime($startDate)) {
        $_SESSION['errmessage'] = "Error: The End Date must be later than the Start Date.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    
    $filePaths = ["", "", ""];
    $fileTitles = ["", "", ""];
    $archiveDir = "fileArchive";
    $uploadedDocs = $_FILES['supportingDocs'];

    if (!file_exists($archiveDir)) {
        mkdir($archiveDir, 0777, true);
    }

    if (!empty($uploadedDocs['name'][0])) {
        $fileCount = count($uploadedDocs['name']);
        if ($fileCount > 3) {
            $_SESSION['errmessage'] = "Error: You can upload a maximum of 3 files.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $uploadedDocs['name'][$i];
            $fileSize = $uploadedDocs['size'][$i];
            $fileTmp = $uploadedDocs['tmp_name'][$i];
            $fileTitle = trim($docTitles[$i] ?? '');

            if (!empty($fileName)) { // Check if the file is uploaded
                if (empty($fileTitle)) {
                    $fileErrors[] = "Title is required for file {$fileName}.";
                    continue;
                }
            }

            if ($fileSize > 2 * 1024 * 1024) { // 2MB size limit
                $fileErrors[] = "File {$fileName} exceeds the size limit of 2MB.";
                continue;
            }

            $destination = $archiveDir . "/" . basename($fileName);
            if (move_uploaded_file($fileTmp, $destination)) {
                $filePaths[$i] = $destination;
                $fileTitles[$i] = $fileTitle;
            }
        }
    }

    if (!empty($fileErrors)) {
        $_SESSION['errmessage'] = implode("<br>", $fileErrors);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    try {
        $query = "INSERT INTO projects (
                    project_id, title, description, customer_name, budget, start_date, end_date, 
                    file1_path, file1_title, file2_path, file2_title, file3_path, file3_title) 
                  VALUES (:projectID, :title, :description, :customerName, :budget, :startDate, :endDate, 
                          :file1Path, :file1Title, :file2Path, :file2Title, :file3Path, :file3Title)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':projectID', $projectID);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':customerName', $customerName);
        $stmt->bindValue(':budget', $budget);
        $stmt->bindValue(':startDate', $startDate);
        $stmt->bindValue(':endDate', $endDate);
        $stmt->bindValue(':file1Path', $filePaths[0]);
        $stmt->bindValue(':file1Title', $fileTitles[0]);
        $stmt->bindValue(':file2Path', $filePaths[1]);
        $stmt->bindValue(':file2Title', $fileTitles[1]);
        $stmt->bindValue(':file3Path', $filePaths[2]);
        $stmt->bindValue(':file3Title', $fileTitles[2]);
        $stmt->execute();

        $_SESSION['sucmessage'] = "Project added successfully!";
        unset($_SESSION['form_data']); // Clear form data on success
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } catch (PDOException $e) {
        $_SESSION['errmessage'] = "Error: Project ID already Exists!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
