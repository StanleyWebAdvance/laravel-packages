

    composer install
    php artisan key:generate
    composer require --dev barryvdh/laravel-ide-helper
    composer require --dev doctrine/dbal
    php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
    php artisan ide-helper:generate
    php artisan ide-helper:meta
    composer require --dev barryvdh/laravel-debugbar
    php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
    
    gitignore - 
        # IDE helper meta-files
        /_ide_helper.php
        /.phpstorm.meta.php
        /_ide_helper_models.php
    
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:
    APP_DEBUG=true
    APP_LOG_LEVEL=debug
    APP_URL=http://localhost
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    QUEUE_DRIVER=sync
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1
    
    TOKEN_KIT=