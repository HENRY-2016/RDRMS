
| -----------------------------------------------------
| PROJECT NAME: 	Recreational Diving Records Management System 
|                   ( RDRMS ) 
| -----------------------------------------------------
| CLIENT NAME:		Gama Samuel
| -----------------------------------------------------
| PROJECT TYPE: 	Student
| -----------------------------------------------------
| DATE: 	August 2023
| -----------------------------------------------------
| PROJECT LINK:    https://rdrms.mogahenze.com
| Admin UserName :: Admin
| Admin Password :: Admin
| -----------------------------------------------------
| DEVELOPER:		MogaHenze
|                   +256 701 243 139  
|                   +256 771 977 854
| -----------------------------------------------------
| EMAIL:			henryatubuntu@gmail.com
| -----------------------------------------------------
| COPYRIGHT BY:		mogahenze.com
| -----------------------------------------------------
| WEBSITE:			https://mogahenze.com
| -----------------------------------------------------

=================
Frame Works Used
================
    Laravel 10
    Bootstrap 5
    Jquery
    CSS / HTML5
    Javascript
    MySql

==============
Project Set Up
==============
    
    1. Controllers
        php artisan make:controller UserAuthenticationController

    2. Tables Models Controller
        admin
            php artisan make:migration create_admin_table --create=admin_table
            php artisan make:model AdminModel -m 
            php artisan make:controller AdminController --resource
            
        students
            php artisan make:migration create_students_table --create=students_table
            php artisan make:model StudentsModel -m 
            php artisan make:controller StudentsController --resource 

        instructors
            php artisan make:migration create_instructors_table --create=instructors_table
            php artisan make:model InstructorsModel -m 
            php artisan make:controller InstructorsController --resource 

        courses
            php artisan make:migration create_courses_table --create=courses_table
            php artisan make:model CoursesModel -m 
            php artisan make:controller CoursesController --resource 

        safety
            php artisan make:migration create_safety_table --create=safety_table
            php artisan make:model SafetyModel -m 
            php artisan make:controller SafetyController --resource

        dives
            php artisan make:migration create_dives_table --create=dives_table
            php artisan make:model DivesModel -m 
            php artisan make:controller DivesController --resource 

        equipments
            php artisan make:migration create_equipments_table --create=equipments_table
            php artisan make:model EquipmentsModel -m 
            php artisan make:controller EquipmentsController --resource 


 



================
Important routes
================
    Migrate db tables:
        /migrate

    Clear route cache:
        /cache-clear

    Clear config cache:
        /config-cache

    Clear application cache:
        /clear-cache

    Clear view cache:
        /view-clear

    Clear route cache:
        /route-cache

    Clear config cache:
        /config-cache

====================
Create Default Admin
====================
    In phpmyadmin in SQL run
        Select Admin table
            INSERT INTO `admin_table`(`id`, `FName`, `LName`, `Contact`, `UserName`, `PassWord`, `created_at`, `updated_at`) VALUES ('1','Admin','Admin','0000000','Admin','Admin','2023-08-29 02:37:33','2023-08-29 02:37:33')



=======
Git Hub
========
1 => git add .
2 => git commit -m 'Initial RDRMS Uploads'
3 => git branch -M main
4 => git push -u origin main
zip -r project.zip project -x "*.git*"