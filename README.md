### Requirements
````
ext-ctype      *           success provided by symfony/polyfill-ctype     
ext-curl       7.4.3       success                                        
ext-dom        20031129    success                                        
ext-fileinfo   7.4.3       success                                        
ext-json       7.4.3       success                                        
ext-libxml     7.4.3       success                                        
ext-mbstring   *           success provided by symfony/polyfill-mbstring  
ext-openssl    7.4.3       success                                        
ext-pcntl      7.4.3       success                                        
ext-pcre       7.4.3       success                                        
ext-phar       7.4.3       success                                        
ext-posix      7.4.3       success                                        
ext-tokenizer  7.4.3       success                                        
ext-xml        7.4.3       success                                        
ext-xmlwriter  7.4.3       success                                        
lib-pcre       10.34       success                                        
php            7.4.3       success
````

### Recommended add-ons
````
sudo apt-get install php-xml
sudo apt-get install php-curl
sudo apt-get install php-redis
````

### Installation

````
cp .env.example .env

composer install

php artisan key:generate

````

### Creating Database Tables
````
php artisan migrate:fresh
````

### Operating the System
````
php artisan horizon
php artisan serve
````

### Extras
````
Horizon and Telescope are added to access
http://127.0.0.1:8000/horizon
http://127.0.0.1:8000/telescope
````
