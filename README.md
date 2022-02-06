## 環境
PHP 8.0.15  
Apache 2.4.52  
mysql 8.0.20  
Composer 2.2.6  

## 導入手順
①git cloneする  
% git clone https://github.com/kamoto0427/laravel-docker.git  

②任意ですが、現在のプロジェクト名はlaravel-dockerなので、自分なりにプロジェクト名変えてもOK  
今回はプロジェクト名をlaravel-dockerにしているので、  
laravel-docker % コマンド  
となっていますが、プロジェクト名を変更したならば、  
プロジェクト名 % コマンド  
でOKです。

③.envファイルを作成し、.envファイルに環境変数を記載
.env_exampleに雛形書いているので、こちらをコピーし、.envを作成→環境変数を設定する  
laravel-docker % cp .env_example .env  

以下のように環境変数を書く。docker-compose.ymlでは、${WEB_PORT}としているので、.envに書いた内容が反映される  
例)
WEB_PORT=18111  
DB_PORT=18222  
DB_NAME=laravel_user  
DB_USER=root  
DB_PASS=secret  
PMA_PORT=18333  
PMA_USER=root  
PMA_PASS=secret  

④dockerコンテナを作成&起動  
laravel-docker % docker-compose up -d

⑤コンテナが立ち上がったか確認  
laravel-docker % docker ps  
CONTAINER ID   IMAGE                     STATUS            NAMES  
ed53d7657c9c   phpmyadmin/phpmyadmin      Up 2 seconds     laravel-docker_phpmyadmin_1  
e097a04f31fc   laravel-docker_php         Up 4 seconds     laravel-docker_php_1  
05d9962d3e35   laravel-docker_mysql       Up 4 seconds     laravel-docker_mysql_1  

⑥phpコンテナに入る  
下記のdocker基本的な操作に記載  

⑦laravel8系をインストール  
/var/www# composer create-project --prefer-dist "laravel/laravel=8.*" .  
> @php artisan vendor:publish --tag=laravel-assets --ansi --force
No publishable resources for tag [laravel-assets].
Publishing complete.
> @php artisan key:generate --ansi
Application key set successfully.  
となれば成功です。  

localhost:${WEB_PORT}  
.envでWEB_PORTは18111にしていれば、  
例)localhost:18111でlaravelの初期画面が出れば成功！  

⑧laravel側の.envも修正する  
src内にlaravelのソースが入っていますが、そこにも.envファイルがあるので、  
DB_CONNECTION=mysql  
DB_HOST=mysql # docker-compose.ymlのmysqlのサービス名(127.0.0.1だとエラー)  
DB_PORT=3306 # ${DB_PORT}:3306とdocker-compose.ymlで設定しているが、${DB_PORT}の値だと接続できない  
DB_DATABASE= # ${DB_NAME}で設定した値  
DB_USERNAME= # ${DB_USER}で設定した値  
DB_PASSWORD= # ${DB_PASS}で設定した値  

⑨マイグレーションを実行する  
phpコンテナに入り、マイグレーションを実行する  
/var/www# php artisan migrate  
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (183.87ms)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (137.12ms)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (242.08ms)
Migrating: 2019_12_14_000001_create_personal_access_tokens_table
Migrated:  2019_12_14_000001_create_personal_access_tokens_table (332.70ms)  
初期のマイグレーションが成功します。

## dockerの基本的な操作
* コンテナを作成するためにビルド、またはdockerファイルを修正してその変更を反映  
laravel-docker % docker-compose up --build

* コンテナのイメージ、作成、起動するなら  
laravel-docker % docker-compose up -d

* コンテナを起動  
laravel-docker % docker-compose start

* コンテナを再起動  
laravel-docker % docker-compose restart

* コンテナ停止  
laravel-docker % docker-compose stop

* コンテナの確認  
laravel-docker % docker ps  
コンテナIDやコンテナ名、コンテナのステータスやポート番号などを確認できる

* phpコンテナに入る  
% docker psでコンテナ情報を確認  
CONTAINER ID IMAGE  COMMAND CREATED  STATUS PORTS  NAMESが確認できる  

% docker exec -it <CONTAINER IDまたはNAMES> bash  

例)コンテナ名の場合  
% docker exec -it laravel-docker_php_1 bash  

* コンテナから抜ける  
/var/www# exit  

* mysqlコンテナに入る  
% docker exec -it <CONTAINER IDまたはNAMES> bash  

例)  
% docker exec -it laravel-docker_mysql_1 bash  
2d3e35:/# 



