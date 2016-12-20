# LFE - Laravel Forums Engine
Forums engine for Your Laravel Framework

### Before installation

#### Register / login the new users
For clean laravel installations, we need auth from the box, to able register/login users.
```
php artisan make:auth
```

#### "Who is Online" feature
```
php artisan session:table
php artisan migrate
```
Please configure the session in `/env` and `/config/sessions.php` to use database driver to succesfull read information.

## Intallation
```
composer require "h-zone/laravel-forums-engine":"dev-master"
```

### Dependent software
Packages will be installed automatically
* Backup commands https://github.com/h-zone/laravel-backup-commands
* BBCode Parcer https://github.com/golonka/bbcodeparser
**You need only setup this packages as described in their instructions**

Adding the Service Provider in config/app.php
```
'providers' => [
    //....
    Hzone\LFE\LFEServiceProvider::class,
    Hzone\BackupCommands\Providers\BackupCommandsServiceProvider::class,
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
