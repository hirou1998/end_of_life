<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/mypage', function (Request $request, Response $response) {

    $data = $request->getQueryParams();

    //$my_ending_note = $this->db;

    $session = $this->session['user_info'];
    $user_id = $session['id'];

    $stmt = $this->db->prepare("SELECT * FROM my_ending_note WHERE user_id = $user_id");
    $stmt->execute();

    $data['my_ending_note'] = $stmt->fetch();

    $stmt = $this->db->prepare("SELECT * FROM profile WHERE user_id = $user_id");
    $stmt->execute();

    $data['profile'] = $stmt->fetch();

    if($data['profile']['user_set_name'] == ""){
      $data['profile']['user_set_name'] = $session["name"];
    }

    // Render index view
    return $this->view->render($response, 'mypage/mypage.twig', $data);
});
