<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/backet-list', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'backet-list/backet-list.twig', $data);
});
