<?php if (isset($_SESSION['errmessage'])): // shows result of actions (success msg or error msg)?> 
    <p class="errormsg"><?= $_SESSION['errmessage'] ?></p>
    <?php unset($_SESSION['errmessage']); ?>
<?php elseif (isset($_SESSION['sucmessage'])): ?>
    <p class="successmsg"><?= $_SESSION['sucmessage'] ?></p>
    <?php unset($_SESSION['sucmessage']); ?>
<?php endif; ?>

<?php $formData = $_SESSION['form_data'] ?? []; ?>
<section id="addProject"> <!-- add id to use it in css class  -->
    <form action="saveProject.php" method="post" enctype="multipart/form-data"> <!-- enc type to handle attachments  -->
    
        <div class="form-row">
            <label for="projectID">Project ID:</label>
            <input type="text" id="projectID" name="projectID"
                value="<?= $formData['projectID'] ?? '' ?>" required pattern="[A-Z]{4}-\d{5}"
                placeholder="XXXX-12345">

            <label for="projectTitle">Project Title:</label>
            <input type="text" id="projectTitle" name="projectTitle"
                value="<?= $formData['projectTitle'] ?? '' ?>" required>
        </div>

        <div class="form-row">
            <label for="projectDescription">Project Description:</label>
            <textarea id="projectDescription" name="projectDescription"
                required><?= $formData['projectDescription'] ?? '' ?></textarea>

            <label for="customerName">Customer Name:</label>
            <input type="text" id="customerName" name="customerName"
                value="<?= $formData['customerName'] ?? '' ?>" required>
        </div>

        <div class="form-row">
            <label for="totalBudget">Total Budget:</label>
            <input type="number" id="totalBudget" name="totalBudget"
                value="<?= $formData['totalBudget'] ?? '' ?>" min="1" required>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate"
                value="<?=$formData['startDate'] ?? ''?>" required>
        </div>

        <div class="form-row">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" value="<?=$formData['endDate'] ?? '' ?>"
                required>
        </div>
        <div>
            <label>Supporting Documents:</label>
            <div class="form-row">
                <input type="file" name="supportingDocs[]" accept=".pdf,.docx,.png,.jpg">
                <input type="text" name="docTitles[]" placeholder="Enter title for this file">
            </div>
            <div class="form-row">
                <input type="file" name="supportingDocs[]" accept=".pdf,.docx,.png,.jpg">
                <input type="text" name="docTitles[]" placeholder="Enter title for this file">
            </div>
            <div class="form-row">
                <input type="file" name="supportingDocs[]" accept=".pdf,.docx,.png,.jpg">
                <input type="text" name="docTitles[]" placeholder="Enter title for this file">
            </div>
        </div>

        <br>
        <input type="submit" value="Add Project">
    </form>
</section>

