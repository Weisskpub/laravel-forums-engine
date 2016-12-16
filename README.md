# LFE - Laravel Forums Engine
Forums engine for Your Laravel Framework

## Attention !
- Support for now Laravel 5.3 only, another versions is not tested!
- Current version - Development, not alpha/beta/gamma....

## Intallation
```
composer require "h-zone/laravel-forums-engine":"^0.1-dev"
```

config/app.php
```
'providers' => [
    //....
    Hzone\LFE\LFEServiceProvider::class,
    //....
],
```
```
'aliases' => [
    //....
    'BBCode'       => \Hzone\LFE\Facades\BBCode::class,
    'Satellite'    => \Hzone\LFE\Facades\Satellite::class,
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

Adding User Trait<br />
Just locate Your User model (i.e. app\User.class)
and add LFEAuthUser Trait
```php
<?php
//....
namespace App;
//....
use Hzone\LFE\Traits\LFEAuthUser;
//....
class User extend Model
{
    //....
    use LFEAuthUser;
    //....
}
```

## Pre-required
Backup Commands for Laravel 5.3+ https://github.com/h-zone/laravel-backup-commands
Doctrine/dbal https://github.com/doctrine/dbal

## Limitations
- "Who is online" works ONLY with database drive of sessions
- LFE works ONLY with default 'Auth' Facade