# お問い合わせフォーム

## 環境構築

1. docker-compose up -d --build
2. docker-compose exec php bash
3. composer install
4. cp .env.example .env
5. .env の環境変数を変更
6. php artisan make:controller ContactController
7. php artisan key:generate
8. composer require laravel/fortify
9. php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
10. php artisan migrate
11. composer require laravel-lang/lang:~7.0 --dev
12. cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/
13. php artisan make:controller AdminController
14. php artisan make:migration create_contacts_table
15. php artisan make:migration create_categories_table
16. php artisan make:model contacts
17. php artisan make:model category
18. php artisan make:controller LoginController
19. php artisan make:request LoginRequest
20. php artisan make:controller RegisterController
21. php artisan make:seeder CategoriesTableSeeder
22. php artisan db:seed
23. php artisan make:factory ContactsFactory
24. php artisan make:seeder ContactsTableSeeder
25. php artisan db:seed --class=ContactsTableSeeder
26. php artisan vendor:publish --tag=laravel-pagination

## 使用技術(実行環境)

- PHP 8.1.33
- Laravel 8.83.8
- MySQL 8.0.26

## ER 図

![image](https://github.com/user-attachments/assets/3e900935-0da0-4f54-a1f6-c58f1db4f9cb)

## URL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

- お問い合わせフォーム入力ページ:http://localhost/
- お問い合わせフォーム確認ページ:http://localhost/confirm
- サンクスページ :http://localhost/thanks
- 管理画面 :http://localhost/admin
- ユーザ登録ページ :http://localhost/register
- ログインページ :http://localhost/login
