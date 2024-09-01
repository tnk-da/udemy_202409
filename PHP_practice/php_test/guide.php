<?php
echo ('こちらはPHPです');
echo ('<br>');
// 変数　動的型付
$test = 123;
var_dump($test);
echo $test;
echo ("<br>");

// 連想配列
$array_member_2 = [
    "田中" => [
        "lastName" => "大智",
        "height" => 170
    ],
    "中田" => [
        "lastName" => "翔平",
        "height" => 165,
    ]
];

echo $array_member_2["田中"]["height"];
echo ("<br>");

//多段階の配列を展開=>foreach{foreach}
foreach ($array_member_2 as $array_member_1) {
    foreach ($array_member_1 as $key => $value) {
        echo "{$key}は{$value}です";
        echo ("<br>");
    }
}

echo ("<br>");

// for, while文
for ($i = 0; $i < 10; $i++) {
    if ($i === 4) {
        continue;   //ターンスキップ
    }
    if ($i === 7) {
        break;      //ループ終了
    }
    echo $i;
}
echo ("<br>");

$data = "3";
// switch
// case "==" で判別している
// 厳密に書くなら　"case $x === y:"
// 条件毎にbreakを書く
switch ($data) {
    case $data === 1:
        echo "1です。";
        break;
    case 2:
        echo "2です。";
        break;
    case 3:
        echo "3です。";
        break;
    default:
        echo "1-3ではありません。";
}
