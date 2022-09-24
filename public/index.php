<?php
/////https://project-awesome.org/nekofar/awesome-slim
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

use App\Http\Controllers\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../resources/views', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));


// Routes
// $app->get('/{name}', function (Request $request, Response $response, array $args) {
//    $view = Twig::fromRequest($request);
   
//    return $view->render($response, 'app.twig', [
//     'name' => $args['name'],
//    ]);
// })->setName('home');

$app->get('/{name}', [HomeController::class, 'index']);

$app->run();



/**
 * 
 * session
 * https://github.com/bryanjhv/slim-session
 */