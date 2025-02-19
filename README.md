# Task-Allocation
Task Allocator Pro (TAP) is a task management system that facilitates efficient task allocation  and monitoring for small teams. The system enables managers to assign tasks, monitor  progress, and review task completion. Team members can view and update tasks assigned  to them.
## ✅ Authentication System  

### ▶ Sign In Page  

The **Sign In** page ensures secure authentication for users. It manages user sessions and protects credentials through encryption.  

Users can:  
- Enter their **email** and **password** to log in.  
- Click the **Sign In** button to access their dashboard.  
- Navigate to the **Sign Up** page if they don’t have an account.  

![Sign In Page](https://github.com/user-attachments/assets/5ef507cf-c3a6-4a9b-847c-a7f550df6429)  

The system ensures **secure authentication** and prevents unauthorized access through **session handling and encryption mechanisms**.  

---

### ▶ Multi-Step Sign Up Process  

The **Sign Up** page ensures a structured and secure user registration process. It includes validation criteria to verify each input field, preventing incorrect or incomplete entries.  

Users must provide:  
- **Personal Information**: First name, last name, email, phone number, and ID number.  
- **Address Details**: Flat/house number, street, city, and country.  
- **Additional Details**: Date of birth, role selection, qualifications, and skills.  

![Sign Up Page](https://github.com/user-attachments/assets/852439e0-9994-41cc-9185-3bad683fac51)  

#### Step 1: User Details Submission  

Users must fill out a registration form with personal and professional details. Each field is validated to ensure correctness.  

![Sign Up Form](https://github.com/user-attachments/assets/46b50e08-bf29-4575-923d-6b4dbbc33373)  

#### Step 2: Set Username and Password  

After successful submission of the initial form, users are prompted to create a **username** and a **strong password**.  

![Set Username & Password](https://github.com/user-attachments/assets/1cadb1a8-4b32-4d75-ba6c-5529fa3d2ff5)  

- **Password Security Measures**:  
  - Enforces strong password criteria.  
  - Validates input to ensure passwords match.  
  - Displays real-time error messages for incorrect entries.  

#### Step 3: Error Handling for Password Validation  

If the passwords do not match or fail security requirements, an error message is displayed.  

![Password Error Message](https://github.com/user-attachments/assets/815bb9a9-5863-4b4b-b1c9-b59836090829)  

#### Step 4: Confirm Registration Details  

Before finalizing the registration, users are shown a **summary of their entered details** for verification.  

![Confirmation Page](https://github.com/user-attachments/assets/309e55a8-5f85-4941-9a8a-0687c2efdd51)  

#### Step 5: Unique User ID Generation & Account Activation  

Once confirmed, the system generates a **unique User ID** for the registered user. A success message is displayed along with an option to proceed to the login page.  

![User ID Generation & Login Redirect](https://github.com/user-attachments/assets/fbe2c7c0-9729-48f0-b38d-dadd083f5966)  

---

## ✅ Project Management  

### ▶ Adding a New Project  

Managers can create a project by filling out the following required details:  
- **Project ID** (Unique Identifier)  
- **Project Title**  
- **Project Description**  
- **Customer Name**  
- **Total Budget**  
- **Start Date & End Date** (System ensures end date is after start date)  
- **Supporting Documents** (Optional file upload with specific formats and size limits)  

![Add Project Page](https://github.com/user-attachments/assets/4cf06dc6-1457-4b7c-a66b-405390860112)  

### ▶ Error Handling: Invalid Input  

If any field is incorrect, such as setting an **end date before the start date**, an error message is displayed, preventing submission.  

![Error Handling Example](https://github.com/user-attachments/assets/260abf41-4cb2-44a7-90e0-6f6ea209717e)  

### ▶ Successful Project Creation  

Once all fields are correctly filled, the system confirms project creation with a **success message**.  

![Project Added Successfully](https://github.com/user-attachments/assets/475fb211-dfae-4c3f-88aa-497555b34a78)  

---

## ✅ Team Leader Allocation  

### ▶ Viewing Available Projects  

Managers can view all existing projects in a structured table. Each project entry includes:  
- **Project ID**  
- **Project Title**  
- **Start & End Dates**  
- **Action Column**: Allows managers to allocate a team leader.  

![Project List - Allocate Team Leader](https://github.com/user-attachments/assets/c68351eb-82ca-4e45-a52d-42b8dbf66a76)  

### ▶ Assigning a Team Leader  

When a manager clicks **"Allocate Team Leader"**, a form appears displaying project details in **read-only mode**. Managers can then **select a team leader** from a dropdown list.  

![Allocate Team Leader Form](https://github.com/user-attachments/assets/f1c17177-fb78-4339-90a3-ac3dd1e349af)  

### ▶ Successful Allocation  

Once a team leader is selected and confirmed, a **success message** appears, indicating that the project has been successfully assigned.  

---

## ✅ Task Search Functionality

### ▶ Task Search Functionality  

The **Task Search Functionality** allows different user roles to search for tasks based on their access levels:  

- **Managers**: Can search tasks from all projects without restrictions.  
- **Team Leaders**: Can search tasks only within projects they are leading.  
- **Team Members**: Can search for tasks in which they are personally involved.  


### ▶ Search Filters  

Users can filter tasks based on the following criteria:  

- **Priority** (Low, Medium, High)  
- **Status** (Pending, In Progress, Completed)  
- **Start Date & End Date**  
- **Project Name**  

![Task Search Page](https://github.com/user-attachments/assets/b34f4304-ae3c-4110-9614-1543d1cae3c9)  

By default, all tasks appear in the table. Applying filters refines the results to show only the tasks matching the selected criteria.  

### ▶ Filtered Results  

For example, if a user searches for tasks with **"Low Priority"** and **"In Progress"** status, only tasks meeting these conditions will be displayed.  

![Filtered Task Search](https://github.com/user-attachments/assets/63553f72-edcb-4ce1-92d4-fc1cea9bd640)  


### ▶ Table Styling and Visual Indicators  

To enhance readability, the task table uses **color-coded rows** and styling based on priority and status:  

- **Hover Effect**: When hovering over a row, the background color changes to black with white text for better visibility.  
- **Priority Indicators**:  
  - **Low Priority**: Green background with white text.  
  - **Medium Priority**: Yellow background with black text.  
  - **High Priority**: Red background with white text.  
- **Status Indicators**:  
  - **Pending Tasks**: Displayed in gray with italicized text.  
  - **In-Progress Tasks**: Highlighted in light blue with bold text.  
  - **Completed Tasks**: Shown with a strikethrough and a green-bordered row.  

These **visual indicators** help users quickly assess task urgency and progress at a glance.  

### ▶ Key Features  

- **Dynamic Search**: Filter tasks based on multiple criteria.  
- **Role-Based Access**: Different user roles have restricted access to search results.  
- **Visual Indicators**: Tasks are color-coded for better readability.  
- **Real-Time Filtering**: Results update instantly based on the applied filters.  

This functionality streamlines task management, allowing users to track progress efficiently and prioritize workloads. 

---

## ✅ Task Creation

### Overview  

The **Task Creation Feature** allows **Project Leaders** to create tasks within assigned projects. The left-side navigation bar highlights the current active page, ensuring clear and intuitive navigation.  

---

### How It Works  

When a **Project Leader** logs in, they can navigate to the **Task Creation** page and fill out the form to create a new task.  

The required fields include:  
- Task Name  
- Task Description  
- Project Selection  
- Start Date & End Date  
- Effort (man-months)  
- Status (Pending, In Progress, Completed)  
- Priority (Low, Medium, High)  

![Task Creation Page](https://github.com/user-attachments/assets/de183136-b2a0-4982-a34d-581cf5af672e)  


### Task Submission & Validation  

- **Form Validation**: Ensures all fields are filled correctly before submission.  
- **Error Handling**: Prevents submission of incomplete or incorrect data.  
- **Success Message**: When the task is successfully added to the database, a confirmation message appears.  

This ensures **data accuracy** and **efficient task management**.  


This feature allows **Project Leaders** to efficiently create tasks and manage project workflows seamlessly.  

---
## ✅ Assign Team Members to Tasks

### ▶ Overview  

The **Assign Team Members to Tasks** feature allows **Project Leaders** to allocate team members to specific tasks within their assigned projects. The left-side navigation bar highlights the active page for clear navigation.  

---

### ▶ How It Works  

When a **Project Leader** logs in, they can navigate to the **Assign Team Members to Tasks** page and follow these steps:  

1. Select a project from the dropdown list to view its associated tasks.  
2. A table displays the available tasks with relevant details such as **Task ID, Task Name, Start Date, Status, and Priority**.  
3. Click **"Assign Team Members"** to allocate members to a specific task.  

![Assign Team Members Page](https://github.com/user-attachments/assets/4f1ebe50-319e-439f-af12-6bfa454c3fb9)  

### ▶ Task Assignment Process  

Upon selecting a task, the system displays a **read-only task details form** along with an allocation form where the project leader can:  

- Select a **team member** from the dropdown list.  
- Assign a **specific role** within the task.  
- Define the **contribution percentage** for the assigned member.  

![Team Assignment Form](https://github.com/user-attachments/assets/70f905d4-cc35-47e3-8451-45e23d7bbb8f)  


### ▶ Task Submission & Validation  

- **Duplicate Assignment Prevention**: If a team member is already assigned to the task, the system displays an **error message** preventing duplicate allocation.  
- **Successful Assignment Confirmation**: If the assignment is valid, a **success message** is shown, confirming that the team member has been assigned.  

This feature ensures **efficient task allocation, prevents redundancy, and maintains a clear assignment structure** within projects.  


This feature allows **Project Leaders** to efficiently manage team allocations, ensuring smooth project execution and collaboration. 

---

## ✅ Search and Update Task Progress

### Overview  

The **Search and Update Task Progress** feature allows **Team Members** to search for and update progress on their assigned and accepted tasks. The left-side navigation bar highlights the active page for clear navigation.  

---

### How It Works  

When a **Team Member** logs in, they can navigate to the **Search and Update Task Progress** page and follow these steps:  

1. Enter search criteria such as **Task ID, Task Name, or Project Name**.  
2. Click the **Search** button to retrieve tasks matching the criteria.  
3. The system displays a table with task details, including **Task ID, Task Name, Project Name, Progress, Status, and an Update Action**.  
4. Click **"Update"** in the Action column to modify the task's progress.  

![Search Task Progress Page](https://github.com/user-attachments/assets/77984c8b-f49f-4e03-bf30-56281aff0211)  

---

### Updating Task Progress  

Upon selecting **Update**, the system displays a form containing:  

- **Task ID** (Read-only)  
- **Task Name** (Read-only)  
- **Project Name** (Read-only)  
- **Progress (%)** (Editable field for updating progress)  
- **Status** (Automatically updates based on progress input)  

![Update Task Form](https://github.com/user-attachments/assets/b03a2185-511c-4209-b1d1-980891680e85)  

---

### Task Submission & Validation  

- **Progress Limit Validation**: The system ensures that the updated percentage does not exceed 100%.  
- **Task Completion Check**: If progress reaches 100%, the task status is updated to **"Completed"** automatically.  
- **Success Message**: If the update is valid, a **confirmation message** appears confirming that the task progress has been successfully updated.  

This feature ensures **accurate task tracking, prevents over-reporting, and maintains structured progress monitoring**.  

---

### Key Features & Benefits  

- **Efficient Task Tracking**: Enables team members to track and update their assigned tasks seamlessly.  
- **Error Prevention**: Ensures progress updates remain within acceptable limits.  
- **Automated Task Completion**: Automatically marks tasks as completed when reaching 100%.  
- **Real-Time Data Integration**: Updates reflect instantly in the system, ensuring up-to-date progress monitoring.  

This feature allows **Team Members** to efficiently update task progress and ensures accurate tracking for project leaders and managers.  

### **🔔 Note:** 
The **"Accept Task Assignments"** in the navigation bar will have a **yellow background** as an alert to notify members that they have new tasks assigned or tasks that are still pending and need to be either accepted or rejected.  

## ✅ Accept Task Assignments

### Overview  

The **Accept Task Assignments** feature allows **Team Members** to view and manage newly assigned tasks or pending tasks that require acceptance or rejection. The left-side navigation bar highlights the active page for clear navigation.  

**🔔 Note:** The **"Accept Task Assignments"** in the navigation bar will have a **yellow background** as an alert to notify members that they have new tasks assigned or tasks that are still pending and need to be either accepted or rejected.  

---

### How It Works  

When a **Team Member** logs in, they can navigate to the **Accept Task Assignments** page and follow these steps:  

1. View the list of tasks that are either newly assigned or still pending confirmation.  
2. Click the **"Confirm"** link next to a task to proceed with accepting or rejecting it.  

![Assigned Tasks Page](https://github.com/user-attachments/assets/ee5a4df9-59a2-4478-9776-d649027b8688)  

---

### Accepting or Rejecting a Task  

When clicking **"Confirm"**, the system displays a form with **read-only task details** and two action buttons:  

- **Accept Task** (Green Button) – Accepts and activates the task.  
- **Reject Task** (Red Button) – Declines the task, removing it from the member’s pending list.  

![Task Confirmation Form](https://github.com/user-attachments/assets/188c2476-ef5b-45f2-8953-ede01fb4ce50)  

---

### Task Submission & Validation  

- **Acceptance Confirmation**: If a member accepts the task, a **success message** appears, and the task is removed from the pending list.  
- **Rejection Confirmation**: If a member rejects the task, a **notification message** appears confirming the removal of the task.  
- **No Pending Tasks**: When no pending tasks remain, the **yellow background** from the navigation bar is automatically removed.  

![Task Successfully Accepted](https://github.com/user-attachments/assets/a1c0e8e0-e4f3-4e7d-a35c-dc9d040f896e)  

---

### Key Features & Benefits  

- **Efficient Task Handling**: Enables team members to manage assigned tasks quickly.  
- **Clear Notifications**: The yellow background serves as an alert for pending actions.  
- **Error Prevention**: Ensures no task is accepted or rejected without confirmation.  
- **Real-Time Updates**: Accepted or rejected tasks are updated instantly in the system.  

This feature allows **Team Members** to efficiently manage assigned tasks and ensures clarity in task allocation and responsibilities.  

