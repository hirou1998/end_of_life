<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/ending-note', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'ending-note/ending-note.twig', $data);
});
