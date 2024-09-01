<?php

const DB_HOST = "mysql:dbname=udemy_php;host=127.0.0.1;charset=utf8";
const DB_USER = "user_php";
const DB_PASSWORD = "password123";

// 例外処理
try{
    $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD,[
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //返り値を連想配列に
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外を表示する
       PDO::ATTR_EMULATE_PREPARES => false, //SQLインジェクション対策(書き換え阻止)
    ]);
    echo '接続成功';
}catch(PDOException $e){
echo '接続失敗'. $e->getMessage().'\n';
exit();
}

?>