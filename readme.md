# Practical Test

You need to develop an admin portal demo with PHP-Laravel framework. You can use any admin theme as front-end. For database you are recommended to use MYSQL.

The system will consist of multiple role and work based users. Users will have access based on their role, work and department.

## User: 
The user will have username/email, password, fullName, phone etc. You can add more fields if needed. The active users will be able to login by username/email and password.

## User Role: 

| role_id        | role_name        |
| -------------  |:-----------------|
| 1              | Main Admin       |
| 2              | Department Admin |
| 3              | Worker           |

### Main Admin: 
Only the main admin can create a user and assign their role and department  while registering. Main admin will also be able to make users active/inactive and have full access to the system.

### Department Admin: 
Will only be able to view the  list of works and active users of his own department. Will also be able to assign works to users.

### Worker: 
Only be able to see the list of works assigned to them.

## Departments: 

| dept_id        | dept_name    |
| -------------  |:-------------|
| 1              | IT           |
| 2              | HR           |
| 3              | Training     |
| 4              | Finance      |
| 5              | Operation    |

## Works: 

| work_id       | work_name                     | dept      |
| ------------- |-------------------------------| ----------|
| 1             | Network setup and maintenance | IT        |
| 2             | Software Development          | IT        |
| 3             | Recruitment Taks              | HR        |
| 4             | Salary disbursement           | HR        |
| 5             | Budget Calculation            | Finance   |
| 6             | Financial Audit               | Finance   |
| 7             | Product training              | Training  |
| 8             | QA                            | Operation |
| 9             | Customer Support              | Operation |
| 10            | Manage Vendors                | Operation |

#### Note: 
one worker can be assigned to multiple works and One work can be assigned to multiple workers



## Note:
1. You are free to use any library code.
2. Please try to keep your codebase as clean as possible. Line indentation, code
   formatting in both php classes & frontend views should be properly done. 
3. Using Vue.js in the front-end will be prefered but not mandatory.
4. Push your code to our git repo https://github.com/digidevhub/laravel_task_101.git  by creating a new branch with your name 
5. Last date of submission: ##### 10-02-2021 11.59PM
6. Feel Free to Contact avijit.nandy@dgsl.com.bd for any queries.


