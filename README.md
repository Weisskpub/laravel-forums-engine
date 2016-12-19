# LFE - Laravel Forums Engine
Forums engine for Your Laravel Framework

### Before installation

### Setup Laravel

Auth from the Box
```
php artisan make:auth
```

Supporting Who is Online feature by using the database driver of laravel sessions
```
php artisan session:table
php artisan migrate
```
and configure the session in `/env` and `/config/sessions.php`

### Install third-party software
* Backup commands https://github.com/h-zone/laravel-backup-commands
* TinyMCE Wrapper https://github.com/h-zone/laravel-tinymce
* BBCode Parcer https://github.com/golonka/bbcodeparser
* Doctrine/dbal https://github.com/doctrine/dbal

**You should to install and setup this packages manually before continue!**
Sometime it will be integrated into this package.

## Intallation
```
composer require "h-zone/laravel-forums-engine":"dev-master"
```

Adding the Service Provider in config/app.php
```
'providers' => [
    //....
    Hzone\LFE\LFEServiceProvider::class,
    //....
],
```

Publishing
```
php artisan LFE:install
```
See:
* resources/config/LFE.php
* resources/lang/en/LFE.php
* resources/views/LFE

Adding LFE Javascript to layout:<br />
resources/view/layouts/app.blade.php
```
    //....
    <script src="{{url(config('LFE.routes.prefix').'/js')}}"></script>
</body>
//....
```

Add App\User Traits<br />
Just locate Your User model (i.e. app\User.php)<br />
and add Traits
```php
<?php
//....
namespace App;
//....
use Hzone\LFE\Traits\LFEAuthUser;
use Hzone\LFE\Traits\Breadcrumbs;
//....
class User extend Model
{
    //....
    use LFEAuthUser;
    use Breadcrumbs;
    //....
}
```

## Limitations at this version
- "Who is online" works ONLY with database drive of laravel sessions;
- LFE works ONLY with default Laravel Auth mechanism 'from the box'.
