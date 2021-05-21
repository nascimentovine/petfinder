# How to run the project
 * Clone this repository 
 * Run ``` Docker-compose up -d ```
# Creating Database User
    * Enter in container bash docker-compose exec db bash 
    * Run mysql -u root -p123456
    * Run show databases; You will see the our database (laravel)
    * Run GRANT ALL ON laravel.* TO 'petfinder'@'%' IDENTIFIED BY '123456';
    * Run FLUSH PRIVILEGES;
    * Run exit
    * Our user has created!

# Running Migrations
 * Run ``` docker-compose exec app php artisan migrate ```
