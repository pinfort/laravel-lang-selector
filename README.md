# laravel-lang-selector
Create smart multi-language website by laravel

## Basic Usage

### Installation

```bash
composer require pinfort/laravel-lang-selector
```
Attention: Perhaps it is necessary to change the minimum stability of the composer...

### Publish files

```bash
php artisan vendor:publish
```
You will find three new files.
- public/vendor/LangSelector/language.css
    - It is required.
- config/language.php
    - You will edit this file.
- resources/views/vendor/LaravelTopNav/lang_menu.blade.php
    - This file is main view of menu.
    - In basic, you have no need to edit this file.

### Edit config

Edit config/language.php whatever you need.
Read comments in the file.

### Enable library

Add style sheet link to your view. near the line 14

in resources/views/layouts/app.blade.php(created by make:auth command)

```diff
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
+<link href="{{ asset('vendor/LangSelector/language.css') }}" rel="stylesheet">
```

Add following code in your view.

in resources/views/layouts/app.blade.php(created by make:auth command)

near the line 66
```diff
         </li>
     @endguest
+    @include('LaravelLangSelector::lang_menu')
 </ul>
```

Add middleware to your kernel

in App\Http\Kernel.php near the line 38
```diff
 protected $middlewareGroups = [
    'web' => [
        ......
+       \Pinfort\LaravelLangSelector\Middleware\LangSelector::class,
    ],
 ......
 ];
```
