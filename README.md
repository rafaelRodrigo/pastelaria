Sistema Pastelaria
<br>
1 - run:<br>
    git clone git@github.com:rafaelRodrigo/pastelaria.git<br>
2 - cd pastelaria<br>
3 - run<br>
    composer update<br>
5 - Criar o .env de acordo com o .envExemplo e adicionar <br>
    DB_CONNECTION=mysql<br>
    DB_HOST=127.0.0.1<br>
    DB_PORT=3306<br>
    DB_DATABASE=pastelaria<br>
    DB_USERNAME=root<br>
    DB_PASSWORD=<br>
4 - run <br>
    php artisan migrate<br>
    yes<br>
5 - run <br>
    php artisan db:seed --class=TypeProductSeeder<br>
