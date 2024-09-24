Sistema Pastelaria
1 - run:
    git clone git@github.com:rafaelRodrigo/pastelaria.git
2 - cd pastelaria
3 - run
    composer update
5 - Criar o .env de acordo com o .envExemplo e adicionar 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pastelaria
    DB_USERNAME=root
    DB_PASSWORD=
4 - run 
    php artisan migrate
    yes
5 - run 
    php artisan db:seed --class=TypeProductSeeder
