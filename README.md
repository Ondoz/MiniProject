1. composer install
2. php artisan key:generate
3. dont forget copy .env-example to .env
4. open your.env 
    Setting your file as Follows
    
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE={{your database in pgsql}
        DB_USERNAME= {your user}
        DB_PASSWORD= {your pass}
        
5. php artisan migrate --seed or php artisan migrate:fresh --seed


 method | URL | Status | Description
--- | --- | --- | --- 
 GET   | /api/post     | 200    | show all data
 POST  | /api/search   | 200    | get items by code or name
 GET   | /api/post/{code}| 200  | get single item by code
 POST  | /api/post     |201     | create new item 
 PUT   | /api/post/{code}|201   | update existing item by code
 DELETE| /api/post/{code}|200   | delete item
