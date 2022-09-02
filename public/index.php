<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
// use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use App\Http\Controllers\HomeController;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

// Set container to create App iwth on AppFactory
AppFactory::setContainer($container);

// Set view in container
// $container->set('view', function() {
//     return Twig::create(__DIR__ . '/../resources/views', ['cache' => false]);
// });
$twig = Twig::create(__DIR__ . '/../resources/views', ['cache' => false]);


$container->set('HomeController', function (ContainerInterface $container) {
    // retrieve the 'view' from the container
    $view = $container->get('view');
    
    return new HomeController($view);
});
// Create App
$app = AppFactory::create();

// Add Routing Middleware
// $app->addRoutingMiddleware();

// Add Twig-View Middleware
// $app->add(TwigMiddleware::createFromContainer($app));
$app->add(TwigMiddleware::create($app, $twig));

$app->add(function (Request $request, RequestHandler $handler) {
    return $handler->handle($request);
});

$app->addErrorMiddleware(true, true, true);

// $container->set('myService', function(){
//     $setting = [HomeController::class => new HomeController];
//     return new MyService($settings);
// });

//  $app->get('/{name}', function(Request $request, Response $response, $args){
//     return $this->get('view')->render($response, 'app.twig', [
//         'name' => $args['name']
//     ]);
//  });


$app->get('/{name}', [HomeController::class, 'index']);

$app->run();