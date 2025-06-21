# アプリケーション名
お問い合わせフォーム
## 環境構築
**Dockerビルド**
1. `git clone git@github.com:hiroya-0425/yosuehiroya-kadai1.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを コピーして「.env」を作成し、DBの設定を変更
``` text
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```
## 使用技術
PHP 8.4.6
Laravel 8.83.8
MySQL 8.0.26
Docker

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

## 補足
このアプリケーションは「お問い合わせフォーム」です。
入力フォーム → 確認画面 → 送信完了 の3ステップで構成されています。
フロントエンドのCSSはページごとに分割されています
usersテーブルは ログイン機能のために使用しており、contactsやcategoriesとは直接リレーションしていません。
ER図はindex.drawioです