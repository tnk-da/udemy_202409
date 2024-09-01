<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

function defaultValue($string = null) //引数には初期値を設定  
{
  echo $string . 'です';
}

//引数なし
defaultValue();
echo '<br>';

//引数あり
defaultValue('テスト');
