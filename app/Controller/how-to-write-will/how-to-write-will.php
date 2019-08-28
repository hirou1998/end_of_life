<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/how-to-write-will', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'how-to-write-will/how-to-write-will.twig', $data);
});
