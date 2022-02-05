## ファイル構造
laravel-docker
  ├── docker
  │   ├── mysql
  │   │    ├── Dockerfile
  │   │    └── php.ini
  │   └── nginx
  │   │     └── default.conf
  │   └── php
  │       ├── Dockerfile
  │       └── php.ini
  └── src
  │    └──  Laravelのプロジェクトファイル
  ├── .env (.gitignoreに.envはgit管理しないようにしている。)
  ├── .gitignore
  └── docker-compose.yml
