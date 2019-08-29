<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\MyEndingNote;

// TOPページのコントローラ
$app->get('/favorite/{user_id}', function (Request $request, Response $response, $argc) {

    $myendingnote = new MyEndingNote($this -> db);

    $param["user_id"] = $argc["user_id"];

    $result = $myendingnote -> select($param, "", "", "1", false);
    
    // dd($result["favorite"]);
    
    $sql = "update my_ending_note set favorite = favorite+1 Where user_id = :user_id";
    $stmt = $this->db->prepare($sql);
    $stmt -> bindParam(":user_id", $param["user_id"], PDO::PARAM_INT);
    $stmt->execute();

    $result = $myendingnote -> select($param, "", "", "1", false);
    
    echo($result["favorite"]);
});