<?php

use App\Controllers\IndexController;
use App\Packages\Core\Engine\Application;
use App\Packages\Tasks\Repositories\TaskRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__.'/../vendor/autoload.php';

$session = new Session(new NativeSessionStorage());
$session->start();

/** @var Application $app */
$app = require __DIR__.'/../bootstrap/app.php';

$request = Request::createFromGlobals();

$controller = new IndexController($app->make(TaskRepository::class), $session);

return $controller->index($request);




