<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/my-ending-note', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'my-ending-note/my-ending-note.twig', $data);
});
