<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/funeral-hall', function (Request $request, Response $response) {

  $funeral_hall_table = $this->db;

  // $html = file_get_contents('https://www.mhlw.go.jp/bunya/kenkou/seikatsu-eisei24/');
  // $data = array();
  // $doc = phpQuery::newDocument($html);
  // foreach($doc[".prt-table table tbody tr"] as $row){
  //   $name = pq($row)->find("td:eq(0)")->text();
  //   $adress = pq($row)->find("td:eq(1)")->text();
  //   $telephone = pq($row)->find("td:eq(2)")->text();
  //   $url = pq($row)->find("td:eq(5)")->text();
  //
  //   if($name){
  //     $funeral_hall_table->insert('funeral_hall',
  //                               array("funeral_hall_name" => $name,
  //                                     "funeral_hall_adress" => $adress,
  //                                     "funeral_hall_telephone" => $telephone,
  //                                     "funeral_hall_url" => $url));
  //   }
  //
  //   array_push($data, [$name, $adress, $telephone, $url]);
  // }
  //
  //$data = [];
  $data = $request->getQueryParams();

  $where1 = "";
  $where2 = "";

  if(!empty($data['name'])){
    $query_name = $data['name'];
    $where1 = "WHERE funeral_hall_name LIKE '%$query_name%'";
  }
  if(!empty($data['adress'])){
    $query_adress = $data['adress'];
    $where2 = "WHERE funeral_hall_adress LIKE '%$query_adress%'";
  }
  if (!empty($query_name) && !empty($query_adress)) {
    $where = $where1 . "AND" . $where2;
  } else{
    $where = $where1 . $where2;
  }

  $sql = "SELECT * FROM funeral_hall " . $where;

  $stmt = $this->db->prepare($sql);
  $stmt->execute();

  $data['funeral_hall_list'] = $stmt->fetchAll();

  //dd($data['funeral_hall_list']);
  //dd($sql);
  //var_dump($data['funeral_hall_list']);

    // Render index view
    return $this->view->render($response, 'funeral-hall/funeral-hall.twig', $data);
});
