<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/upload', function (Request $request, Response $response) {

    return $this->view->render($response, 'sample/upload.twig');
});

// 画像アップロード
$app->post('/upload', function (Request $request, Response $response) {

    $user_id=1;

    $files = $request->getUploadedFiles();
    $file = $files["image"]->file;

    $file_path = "public/assets/img/profile-image-" . $user_id . ".png";
    copy($file, $file_path);


    // ここで$server_pathをDBにinsertする

});
