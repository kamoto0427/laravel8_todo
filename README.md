## 環境
PHP 8.0.15  
Apache 2.4.52  
mysql 8.0.20  

## 導入手順
①git cloneする  
% git clone https://github.com/kamoto0427/laravel-docker.git  

②任意ですが、現在のプロジェクト名はlaravel-dockerなので、自分なりにプロジェクト名変えてもOK  
今回はプロジェクト名をlaravel-dockerにしているので、  
laravel-docker % コマンド  
となっていますが、プロジェクト名を変更したならば、  
プロジェクト名 % コマンド  
でOKです。

③.envファイルを作成する  
.env_exampleに雛形書いているので、こちらをコピーし、.envを作成→環境変数を設定する  
laravel-docker % cp .env .env_example

④dockerコンテナを作成&起動  
laravel-docker % docker-compose up -d

⑤コンテナが立ち上がったか確認  
laravel-docker % docker ps  
CONTAINER ID   IMAGE                     STATUS            NAMES  
ed53d7657c9c   phpmyadmin/phpmyadmin      Up 2 seconds     laravel-docker_phpmyadmin_1  
e097a04f31fc   laravel-docker_php         Up 4 seconds     laravel-docker_php_1  
05d9962d3e35   laravel-docker_mysql       Up 4 seconds     laravel-docker_mysql_1  

## .envファイルに環境変数を書く
* docker-compose.ymlや.gitignoreと同じ階層に.envを作成  
.envはgit管理しないように注意する。(.gitignoreに記述)  
以下のように環境変数を書く。docker-compose.ymlでは、${WEB_PORT}としているので、.envに書いた内容が反映される  
WEB_PORT=  
DB_PORT=  
DB_NAME=  
DB_USER=  
DB_PASS=  
PMA_PORT=  
PMA_USER=  
PMA_PASS=  

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



