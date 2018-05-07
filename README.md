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
You will find two new files.
- config/language.php
    - You will edit this file.
- resources/views/vendor/LaravelTopNav/lang_menu.blade.php
    - This file is main view of menu.
    - In basic, you have no need to edit this file.

### Edit config

Edit config/language.php whatever you need.
Read comments in the file.

### Enable library

Add following code in your view.

in resources/views/layouts/app.blade.php(created by make:auth command)

near the line 66
```diff
         </li>
     @endguest
 </ul>
+@include('LaravelLangSelector::lang_menu')
```
