# Laravel Fresh Install

1. Install dependencies and create your own copy of .env.examle (without the .example)

  ``` composer install ```

2. Generate new Application Key 

  ``` php artisan key:generate ```

3. Default timezone: 'America/Sao_Paulo'
4. Set Application Name ( http://www.php-fig.org/psr/psr-4/ )
  
  ``` php artisan app:name BaseLaravel ```

5. Default template for maintenance mode responses can be found at resources/views/errors/503.blade.php
6. !IMPORTANT! Routes defined using Route Partials (see Http/Routes/routes.php)  
7. Basic Checkrole middleware added
8. Authentication accepting login with username or email, based on Scafold package 
9. MUST delete the following files to avoid errors:
  - Controllers/ExampleController.php
  - Requests/ExampleRequest.php
  - Models/Example.php
  - Presenters/ExamplePresenter.php
  - Repositories/ExampleRepository.php & ExampleRepositoryEloquent.php
  - Transformers/ExampleTransformer.php
  - Unbind the ExampleRepository and ExampleRepositoryEloquent in the Providers/RepositoryServiceProvider.php

# Repositories included

- Laravel 5 Repositories ( https://github.com/andersao/l5-repository )
  - Fractal Presenter from PHPLeague ( http://fractal.thephpleague.com/ )
- Carbon ( https://github.com/briannesbitt/Carbon )
- Subtree split of the Illuminate HTML component( https://github.com/illuminate/html )

# Other info

1. Global helper functions examples
  - env('DB_DATABASE') to access .env file and show DB_DATABASE constant
  - config('app.timezone') to access 'app' file and show timezone property, pass an array to set configuration values
2. storage and bootstrap/cache directories MUST be writable by web server

# Thanks to the following packages which helped me to build this
    - Scafold ( https://github.com/bestmomo/scafold )