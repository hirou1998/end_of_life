<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/profile_edit/', function (Request $request, Response $response) {

    // $data = $request->getQueryParams();
    //
    // //$my_ending_note = $this->db;
    //
    // $session = $this->session['user_info'];
    // $user_id = $session['id'];
    //
    // $stmt = $this->db->prepare("SELECT * FROM my_ending_note WHERE user_id = $user_id");
    // $stmt->execute();
    //
    // $data['my_ending_note'] = $stmt->fetch();
    $data = [];

    // Render index view
    return $this->view->render($response, 'profile_edit/profile_edit.twig', $data);
});
