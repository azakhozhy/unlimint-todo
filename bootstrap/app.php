<?php

declare(strict_types=1);

use App\Packages\Core\Engine\Application;
use App\Packages\Core\Engine\Router;
use App\Packages\Core\Engine\Session;
use App\Packages\Core\Repositories\UserRepository;
use App\Packages\Core\Services\AuthService;
use App\Packages\Tasks\Managers\TaskManager;
use App\Packages\Tasks\Repositories\TaskRepository;
use Symfony\Component\HttpFoundation\Request;

Session::start();

$config = require __DIR__.'/../config.php';
$routes = require __DIR__.'/routes.php';

$app = new Application(dirname(__DIR__).'/', $config);

$app->singleton(Session::class);
$app->singleton(TaskManager::class);
$app->singleton(UserRepository::class);
$app->singleton(TaskRepository::class);
$app->singleton(AuthService::class, fn(Application $app) => new AuthService($app->make(Session::class)));
$app->singleton(Request::class, fn(Application $app) => Request::createFromGlobals());
$app->singleton(Router::class, fn(Application $app) => new Router($app, $routes));

return $app;

