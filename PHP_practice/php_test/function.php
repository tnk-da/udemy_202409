<?php

function calculate ($num1,$num2){
    $total = $num1 + $num2;
    if ($num1 >= $num2){
        $difference = $num1 - $num2;
    }else{
        $difference =  $num2 - $num1;
    }
    return [$total, $difference];
}

$value = calculate(13, 22);

echo "合計は{$value[0]}です。";
echo ("<br>");
echo "差は{$value[1]}です。";


$string = "abcde";
// 文字数
strlen($string);
// アルファベット以外の場合
mb_strlen($string);

// 指定文字列で分割
$string_2 = "途中で、分割します";
var_dump(explode('、',$string_2));

echo "<br>";

// 正規表現
$str_3 = "特定の文字列が含まれるか";
echo preg_match('/文字列/',$str_3);
//  =>含む場合「1」を返す。

// 指定文字列から文字を取得する
echo substr("あいう",2);
// 英語以外はmbで
echo mb_substr("かきくけこ",2);

// 関数リファレンス
// https://www.php.net/manual/ja/funcref.php
?>