# live-code-editor (demo module)

# installation

Requirements:

- Laragon 6.0
- Php 8.3.0 or above
- mySQL 8.0 or above
- Apache 2.4.x.x or above
- Composer 2.7.x or above

How to install this application:

1. Clone the repository from the below GitHub Repository link into the directory “laragon/www”
    
    [references](https://www.notion.so/references-0177f1582bf9448db5e184ec3164c80a?pvs=21)
    
2. Start Laragon service (must stop all other services like XAMPP,…)
3. Copy the “.env.example” to another file in the dictionary and rename it to “.env”
4. Open the terminal at the root dictionary of the repo, and run “composer install”
5. At the terminal, run “php artisan key:generate”, then run “php artisan migrate”
6. As the repo was named “live-code-editor” and the default virtual domain of Laragon was set to “.test”, “live-code-editor.test” is the virtual domain of this web application

![image](https://github.com/user-attachments/assets/b2d1cf60-226e-4413-85b6-cf64e8537ac2)
