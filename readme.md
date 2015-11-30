# Laravel Fresh Install


1. Set Application Name & Fix namespaces ( http://www.php-fig.org/psr/psr-4/ )
 
  ``` php artisan app:name BaseLaravel ```

  Some files might not change at all, so, check changes manually before running things
    - at config/repository.php fix rootNamespace
    - at config/auth.php fix model
    - at config/ide-helper.php fix interfaces
    - at config/services.php fix stripe
  
  Or, delete and re-publish vendor config files
  
2. Create copy of env.examle (without the .example) & Generate new Application Key 

  ``` php artisan key:generate ```
  
3. Install dependencies

``` 
  composer install 
```
3. !INFO! Default timezone is set to: 'America/Sao_Paulo'
5. !IMPORTANT! Routes defined using Route Partials (see Http/Routes/routes.php)  
6. !INFO! Basic Checkrole middleware added
7. !INFO! Authentication accepting login with username or email, based on Scafold package
8. Publish vendors and generate laravel helpers 

```
  php artisan clear-compiled
  php artisan ide-helper:generate
  php artisan ide-helper:meta
  php artisan ide-helper:models
  php artisan optimize
```

# Repositories included

- Laravel 5 Repositories ( https://github.com/andersao/l5-repository )
  - Fractal Presenter from PHPLeague ( http://fractal.thephpleague.com/ )
- Carbon ( https://github.com/briannesbitt/Carbon )
- Illuminate/Html ( https://github.com/illuminate/html )
- Laravel 5 Extended Generators ( https://github.com/laracasts/Laravel-5-Generators-Extended )
- Intervention Image ( https://github.com/Intervention/image )
- Eloquent-Sluggable ( https://github.com/cviebrock/eloquent-sluggable )
  - Added doctrine/dbal: ~2.3 in order to generate automatic phpDocs for models 
- DebugBar ( https://github.com/barryvdh/laravel-debugbar )

# Other nice info to remember

1. Global helper functions ( \vendor\laravel\framework\src\Illuminate\Foundation\helpers.php )
2. storage and bootstrap/cache directories MUST be writable by the web server
