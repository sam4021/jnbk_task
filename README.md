Samson Wandah - JNBK Task

For JWT I use this package: tymon/jwt-auth
Models:
- Users
- Product
- Category
- ProductCategory

* User
- Register: POST  /api/auth/register
    - Fields: name, email, password, password_confirmation

- Login: POST /api/auth/login
    - Fields: email, Password   
    - you will be issued with a token


	
GET	/api/auth/user-profile
POST	/api/auth/refresh
POST	/api/auth/logout









Requirement
Create a simple and secure REST API using Laravel and SQL database.
The project shall contain the following functionality:
● JWT token
● Admin / User authentication is required
● One or more model (Table) is required
● CRUD API is required

Assessment
We will be reviewing the submitted application using the following guidelines:
● Does the app handle error conditions?
● Does the app perform the required functionality?
● Is the code well-formatted?
● Does the code contain comments if not self-explanatory?

Deliverables
• A final version of your code as a zip archive or private repository link.
• Readme file that explains how to run/test applications locally.
