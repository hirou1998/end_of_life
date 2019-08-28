<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/grave', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'grave/grave.twig', $data);
});
