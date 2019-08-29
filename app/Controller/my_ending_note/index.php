<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/my-ending-note/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'my-ending-note/my-ending-note.twig', $data);

});

// MYエンディングノートロジックコントローラ
$app->post('/my_ending_note/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();
    $session = $this->session['user_info'];
    $user_id = $session['id'];

    $my_ending_note = $this->db;

    $my_ending_note->insert('my_ending_note',
                            array("user_id" => $user_id,
                                  "my_history" => $data['my_history'],
                                  "my_friends_relatives" => $data['my_friends_relatives'],
                                  "my_property" => $data['my_property'],
                                  "my_desire" => $data['my_desire'],
                                  "my_funeral" => $data['my_funeral'],
                                  "my_comment" => $data['my_comment'],
                                  "is_public" => $data['is_public']
                                ));

    return $response->withRedirect('/mypage');

});

$app->get('/my-ending-not/edit/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    $session = $this->session['user_info'];
    $user_id = $session['id'];

    $stmt = $this->db->prepare("SELECT * FROM my_ending_note WHERE user_id = $user_id");
    $stmt->execute();

    $data['my_ending_note'] = $stmt->fetch();

    // Render index view
    return $this->view->render($response, 'my-ending-note/my-ending-note.twig', $data);

});
