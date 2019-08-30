<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/graveyard', function (Request $request, Response $response) {

  // $graveyard = $this->db;
  //
  // for($i=0; $i<51; $i++){
  //   $url = 'https://www.navitime.co.jp/category/0517/' . '?page=' . $i;
  //   $html = file_get_contents($url);
  //   $data = array();
  //   $doc = phpQuery::newDocument($html);
  //   foreach($doc["#spot_list li"] as $row){
  //     $name = pq($row)->find("dt a")->text();
  //     $adress = pq($row)->find("dd:eq(0)")->text();
  //     $telephone = pq($row)->find("dd:eq(1)")->text();
  //     $url = pq($row)->find("dt a")->attr("href");
  //
  //     if($name){
  //       $graveyard->insert('graveyard',
  //                                 array("graveyard_name" => $name,
  //                                       "graveyard_adress" => $adress,
  //                                       "graveyard_telephone" => $telephone,
  //                                       "graveyard_url" => $url));
  //     }
  //
  //     array_push($data, [$name, $adress, $telephone, $url]);
  //   }
  // }
  //
  $data = $request->getQueryParams();

  $where1 = "";
  $where2 = "";

  if(!empty($data['name'])){
    $query_name = $data['name'];
    $where1 = "WHERE graveyard_name LIKE '%$query_name%'";
  }
  if(!empty($data['adress'])){
    $query_adress = $data['adress'];
    $where2 = "WHERE graveyard_adress LIKE '%$query_adress%'";
  }
  if (!empty($query_name) && !empty($query_adress)) {
    $where = $where1 . "AND" . $where2;
  } else{
    $where = $where1 . $where2;
  }

  $sql = "SELECT * FROM graveyard " . $where;

  $stmt = $this->db->prepare($sql);
  $stmt->execute();

  $data['graveyard_list'] = $stmt->fetchAll();

  //dd($sql);
  //dd($where2);


    // Render index view
    return $this->view->render($response, 'graveyard/graveyard.twig', $data);
});
