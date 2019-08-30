<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/profile_edit/', function (Request $request, Response $response) {

    $data = $request->getQueryParams();

    $session = $this->session['user_info'];
    $user_id = $session['id'];
    //
    $stmt = $this->db->prepare("SELECT * FROM profile WHERE user_id = $user_id");
    $stmt->execute();

    $data['profile'] = $stmt->fetch();

    return $this->view->render($response, 'profile_edit/profile_edit.twig', $data);

    // Render index view
    //return $this->view->render($response, 'profile_edit/profile_edit.twig', $data);
});

$app->post('/profile_edit/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    $session = $this->session['user_info'];
    $user_id = $session['id'];

    //dd($data['birthday']);

    $profile_edit = $this->db;

    $profile_edit->delete('profile', array('user_id' => $user_id));

    $files = $request->getUploadedFiles();
    //dd($files);
    $file = $files["img"]->file;
    if($file){
      $file_path = "/opt/intern/app/team-b/project/public/assets/img/profile-image-" . $user_id . ".png";
      copy($file, $file_path);
    } else {
      $file_path = null;
    }

    $file_path = "/assets/img/profile-image-" . $user_id . ".png";

    $data['birthday'] = $data['birthday'] != "" ? $data['birthday'] : null;

    $profile_edit->insert('profile',
                            array("user_id" => $user_id,
                                  "user_set_name" => $data['user_set_name'],
                                  "birthday" => $data['birthday'],
                                  "location" => $data['location'],
                                  "introduction" => $data['introduction'],
                                  "img" => $file_path
                                ));

    $stmt = $this->db->prepare("SELECT * FROM profile WHERE user_id = $user_id");
    $stmt->execute();

    $data['profile'] = $stmt->fetch();

    return $this->view->render($response, 'profile_edit/profile_edit.twig', $data);

});
