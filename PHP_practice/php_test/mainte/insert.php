<?php

// DB接続 PDO
function insertContact($request){
  require 'db_connection.php';

  // 入力 DB保存 prepare, execute(配列(全て文字列))

  $params = [
    'id' => null,
    'your_name' => $request['your_name'],
    'email' => $request['email'],
    'url' => $request['url'],
    'gender' => $request['gender'],
    'age' => $request['age'],
    'contact' => $request['contact'],
    'created_at' => null
  ];

  // $params = [
  //   'id' => null,
  //   'your_name' => 'なまえ123',
  //   'email' => 'test@test.com',
  //   'url' => 'http://test.com',
  //   'gender' => '1',
  //   'age' => '2',
  //   'contact' => 'いいい',
  //   'created_at' => null
  // ];

  $count = 0;
  $columns = '';
  $values = '';

  foreach(array_keys($params) as $key){   // array_keysでkeyを取得
    if($count++>0){
      $columns .= ',';
      $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key;
  }

  var_dump($sql);
  // exit;

  $sql = 'insert into contacts ('. $columns .')values('. $values .')';
  $stmt = $pdo->prepare($sql);//プリペアードステートメント
  $stmt->execute($params); //実行
}
