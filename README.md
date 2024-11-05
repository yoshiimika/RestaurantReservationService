# 飲食店予約システム
飲食店予約システムを作成しました。
ユーザーはログイン後、以下の機能を利用可能です。
- お気に入り追加/削除
- 予約追加/変更/キャンセル
- レビュー追加/編集/削除
- 決済機能  
決済機能はStripeを利用しています。支払金額入力ページで支払額を入力の上、決済ページに移行する事で決済が可能です。
 
また、店舗代表者はログイン後、以下の機能を利用可能です。
- 予約一覧情報取得（日付ごと）
- QRコードで予約認証  
リマインドメールに添付されたQRコードを店舗側で読み取ることで、予約情報（予約ID、予約者名、予約日、予約時間、予約人数）の確認が可能です。同時に、ユーザーステータスが「予約済」から「来店済」に更新されます。
- お知らせメール送信  
お知らせメール作成ページでは、過去に来店したユーザー・予約中のユーザーの中からメール送付相手を選択し、メールを送信することができます。
- 店舗情報作成/編集  
「店舗を持たない店舗代表者」がログインした時は「店舗の作成」、「店舗を持つ店舗代表者」がログインした時は「店舗情報編集」のメニューバーがそれぞれ表示されるように切り分けています。店舗作成後は、作成した店舗と店舗代表者が自動的に結びつくようになっています。

管理者はログイン後、以下の機能を利用可能です。
- 店舗代表者一覧情報取得
- 店舗代表者作成/編集/削除  
店舗代表者が店舗作成を行えるよう、「店舗を持たない店舗代表者」も作成可能としています。
<img width="1506" alt="スクリーンショット 2024-11-05 7 43 17" src="https://github.com/user-attachments/assets/2671fad3-6253-46f3-9fb7-39af1ec8b878">

## 作成した目的
学習のアウトプットとして作成しました。

## URL
- 本番環境：
- 開発環境：http://localhost/
- phpMyAdmin:http://localhost:8080/

## 機能一覧
- 会員登録機能
- メール認証
- ログイン機能
- ログアウト機能
- 店舗検索（エリア・ジャンル・店名）
- リマインドメール送信
ユーザー権限
- お気に入り追加/削除
- 予約追加/変更/キャンセル
- レビュー追加/編集/削除
- 決済機能
店舗代表者権限
- 予約一覧情報取得（日付ごと）
- ページネーション（５件ずつ取得）
- QRコードで予約認証
- お知らせメール送信
- 店舗情報作成/編集
管理者権限
- 店舗代表者一覧情報取得
- 店舗代表者作成/編集/削除

## 使用技術（実行環境）
- laravel8.0
- MySQL8.0
- docker
- PHP
- laravel-fortify
- Stripe
- javascript

## テーブル設計
<img width="332" alt="スクリーンショット 2024-11-05 7 52 16" src="https://github.com/user-attachments/assets/7e3553e5-5d6b-47b1-9eeb-1f2f577be062">

## ER図
![ER_diagram](https://github.com/user-attachments/assets/dcb0233c-dedf-47e1-8408-a323c63ed571)

# 開発環境
## Dockerビルド

1.ディレクトリの作成  
プロジェクトのディレクトリ構造を以下のように作成して下さい。
<pre>
RestaurantReservationService  
├── docker  
│   ├── mysql  
│   │   ├── data  
│   │   └── my.cnf  
│   ├── nginx  
│   │   └── default.conf  
│   └── php  
│       ├── Dockerfile  
│       └── php.ini  
├── docker-compose.yml  
└── src  
</pre>

2.docker-compose.ymlの作成  
`docker-compose.yml`ファイルに、以下の内容を追加して下さい。  
```
version: '3.8'

services:
    nginx:
        image: nginx:1.21.1
        ports:
            - "80:80"
        volumes:
            - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
            - ./src:/var/www/
        depends_on:
            - php

    php:
        build: ./docker/php
        volumes:
            - ./src:/var/www/

    mysql:
        image: mysql:8.0.26
        environment:
            MYSQL_ROOT_PASSWORD: root
            MYSQL_DATABASE: laravel_db
            MYSQL_USER: laravel_user
            MYSQL_PASSWORD: laravel_pass
        command:
            mysqld --default-authentication-plugin=mysql_native_password
        volumes:
            - ./docker/mysql/data:/var/lib/mysql
            - ./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf
```

3.Nginxの設定  
`docker/nginx/default.conf`ファイルに以下の内容を追加して下さい。
```
server {
    listen 80;
    index index.php index.html;
    server_name localhost;

    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
```

4.PHPの設定  
`docker/php/Dockerfile`ファイルに以下の内容を追加して下さい。
```
FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    && apt install -y libpng-dev libjpeg-dev libfreetype6-dev libmagickwand-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www
```

5.MySQLの設定  
`docker/mysql/my.cnf`ファイルに以下の内容を追加して下さい。
```
[mysqld]
character-set-server = utf8mb4

collation-server = utf8mb4_unicode_ci

default-time-zone = 'Asia/Tokyo'
```

6.phpMyAdminの設定  
`docker-compose.yml`ファイルに、以下の内容を追加して下さい。  
```
    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        environment:
            - PMA_ARBITRARY=1
            - PMA_HOST=mysql
            - PMA_USER=laravel_user
            - PMA_PASSWORD=laravel_pass
        depends_on:
            - mysql
        ports:
            - 8080:80
```

7.docker-compose up -d --build

## Laravel環境開発

1.docker-compose exec php bash

2.composer install

3..env.exampleファイルから.envを作成し、環境変数を変更

4.php artisan key:generate

5.php artisan migrate

6.php artisan db:seed

## ダミーデータの説明
ユーザー一覧  
1.管理者　　　email: admin@admin.com  
2.店舗代表者　email: shop@shop.com　※"shop_id: 1"の代表者  
3.ユーザー　　email: test@test.com  
※パスワードは全て"password"でログインできます。
