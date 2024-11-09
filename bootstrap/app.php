<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

/**
 * Configure Monolog.
 */
$app->configureMonologUsing( function( Monolog\Logger $monolog) {
    $processUser = posix_getpwuid( posix_geteuid() );
    $processName= $processUser[ 'name' ];

    $filename = storage_path( 'logs/laravel-' . php_sapi_name() . '-' . $processName . '.log' );
    $handler = new Monolog\Handler\RotatingFileHandler( $filename );
    $monolog->pushHandler( $handler );
});
