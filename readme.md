## About 

A blog management Laravel project with roles and permissions
Sample role like post_manager, category_manager, user_manager, super_admin, etc.
Each role have specific permission and one or more roles can be assign to a user.
Enjoy and contribute to improve this project...


## Installation
After setting up this application and making sure all composer dependencies are pulled in by running `composer install`, next is to setup the `.env` file making sure that all required fields are provided.
The next step is to run theses commands to migrate the database and seeders.

To initiate the process, run the following commands:

```bash
php artisan migrate:fresh -seed --seeder=GenericDataSeeder
```

## RUN PROJECT
After all the configs please start the project with the command:
```bash
php artisan serve
```


## URL
Online Demo link : in progress...
