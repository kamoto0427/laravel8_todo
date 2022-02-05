## 環境
PHP 8.0.15  
Apache 2.4.52  
mysql 8.0.20  

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



