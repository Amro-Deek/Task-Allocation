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


## ✅ Task Creation

## Overview  

The **Task Creation Feature** allows **Project Leaders** to create tasks within assigned projects. The left-side navigation bar highlights the current active page, ensuring clear and intuitive navigation.  

---

## How It Works  

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

---

## Task Submission & Validation  

- **Form Validation**: Ensures all fields are filled correctly before submission.  
- **Error Handling**: Prevents submission of incomplete or incorrect data.  
- **Success Message**: When the task is successfully added to the database, a confirmation message appears.  

This ensures **data accuracy** and **efficient task management**.  

---

This feature allows **Project Leaders** to efficiently create tasks and manage project workflows seamlessly.  



