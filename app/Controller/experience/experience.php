<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/experience', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'experience/experience.twig', $data);
});
