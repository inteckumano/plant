<?php
  //直接のページ遷移を阻止
  $request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
  if($request !== 'xmlhttprequest') exit;

  //DBへの接続
  //本来は db_connect関数 を作成して、DRYにした方が良いです。
  require_once 'DbManager.php';
  $conn=openconnect();
  
  //Ajaxで渡ってきた値をもとに M_boards から該当する ボード名を抽出
  $cate1 = "none";
  if(isset($_POST['cate1_id'])){
    $cate1 = $_POST['cate1_id'];
  }
  
  $sql = 'SELECT disp_name,board_url FROM [dbo].[M_boards] WHERE cate_id = :cate1_id and del_flg=0';
  $stmt=$conn->prepare($sql);
  $stmt->bindValue(':cate1_id', (int)$cate1, PDO::PARAM_INT);
  $stmt->execute();
  //抽出された値を $cate2_list配列 に格納
  $cate2_list = array();
  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
    $cate2_list[$row['board_url']] = $row['disp_name'];
  }
  
  header('Content-Type: application/json');
  //json形式で index.php へバックする
  echo json_encode($cate2_list);

  

 ?>


