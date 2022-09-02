<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;


class HomeController
{

    
    public function index(Request $request, Response $response, $args)
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'app.twig', [
            'name' => $args['name']
        ]);

        
        // $this->view()->fetchFromString(
        //         '<p>Hi, my name is {{ name }}.</p>',
        //         [
        //             'name' => $args['name']
        //         ]
        //     );

    }
}


