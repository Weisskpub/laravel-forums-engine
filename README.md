# LFE - Laravel Forum Engine
Forum engine for Your Laravel Framework

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
Publishing
```
php artisan LFE:install
```
See:
* resources/config/LFE.php
* resources/lang/en/LFE.php
* resources/views/LFE
