<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/funeral-hall', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'funeral-hall/funeral-hall.twig', $data);
});
