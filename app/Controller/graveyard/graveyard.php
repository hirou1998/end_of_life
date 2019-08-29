<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/graveyard', function (Request $request, Response $response) {

  $data = [];

    // Render index view
    return $this->view->render($response, 'graveyard/graveyard.twig', $data);
});
