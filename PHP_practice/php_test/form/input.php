<?php

//CSRF(偽物のinput.php) => 悪意のあるページ
//偽物ページからの情報か本物ページからの情報かを判断 =>$_SESSIONを利用
//$_GET,$_POSTはデータ送信が一度きり　／　$_SESSIONは永続的
session_start();

require 'validation.php';

//HTTP通信のHTTPヘッダーに情報を追加 =>クリックジャッキング対策
header('X-FRAME-OPTIONS:DENY');

// スーパーグローバル変数 php 9種類
// 連想配列

if (!empty($_POST)) {
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
}

//記号(<,>,",',& を変換した文字列として認識) =>XSS対策
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//入力(input.php)0、確認(confirm.php)1、完了(thanks.php)2

// input.php

$pageFlag = 0;   //0,1,2
$errors = validation($_POST);   //validation.phpの関数を実行&代入

if (!empty($_POST["btn_confirm"]) && empty($errors)) {
  $pageFlag = 1;
}

if (!empty($_POST["btn_submit"])) {
  $pageFlag = 2;
}

?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <!-- 入力画面 -->
  <?php if ($pageFlag === 0) : ?>
    <?php
      if (!isset($_SESSION['csrfToken'])) {           //未生成の場合,トークンキーを作成
        $csrfToken =  bin2hex(random_bytes(32));    //安全なランダムバイト列を生成 , 16進数に変換
        $_SESSION['csrfToken'] = $csrfToken;
      }
      $token = $_SESSION['csrfToken'];
    ?>
      <?php
        if (!empty($errors) && !empty($_POST['btn_confirm'])) : 
      ?>
        <?php echo '<ul>' ?>
        <?php 
          foreach ($errors as $error) { echo '<li>' . $error . '</li>';}
        ?>
        <?php echo '</ul>' ?>
      <?php endif; ?>
      <div class="container">
        <div class="row">
          <!-- widthを12分割で考える =>6/12 -->
          <div class="col-md-6">
            <form method="POST" action="input.php">
              <div class="form-group">
                <label for="your_name">氏名</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="your_name" 
                  name="your_name" 
                  value="<?php if (!empty($_POST['your_name'])) { echo h($_POST['your_name']);} ?>" 
                  required
                >
              </div>

              <div class="form-group">
                <label for="email"> メールアドレス</label>
                <input 
                  type="email" 
                  class="form-control" 
                  id="email" name="email" 
                  value="<?php if (!empty($_POST['email'])) { echo h($_POST['email']);} ?>"
                >
              </div>
              <div class="form-group">
                <label for="url">ホームページ</label>
                <input 
                  type="url" 
                  name="url" 
                  class="form-control" 
                  id="url" 
                  value="<?php if (!empty($_POST['url'])) {echo h($_POST['url']);} ?>"
                >
              </div>
              性別
              <div class="form-check form-check-inline">
                <input 
                  type="radio" 
                  name="gender" 
                  class="form-check-input" 
                  id="gender1" 
                  value="0" <?php if (isset($_POST['gender']) && $_POST['gender'] === '0') { echo 'checked';} ?>
                >
                <label class="form-check-label" for="gender1">男性</label>
                <input 
                  type="radio" 
                  name="gender" 
                  class="form-check-input" 
                  id="gender2" 
                  value="1" 
                  <?php if (isset($_POST['gender']) && $_POST['gender'] === '1') { echo 'checked';} ?>
                >
                <label class="form-check-label" for="gender2">女性</label>
              </div>
              <div class="form-check-label">
                <label for="age">年齢</label>
                <select name="age" class="form-control" id="age">
                  <option value="">選択してください</option>
                  <option 
                    value="1" 
                    <?php if (isset($_POST['age']) && $_POST['age'] === '1') { echo 'checked';} ?>
                  >
                    ～19歳
                  </option>
                  <option 
                    value="2" 
                    <?php if (isset($_POST['age']) && $_POST['age'] === '2') { echo 'checked';} ?>
                  >
                    20～29歳
                  </option>
                  <option 
                    value="3" 
                    <?php if (isset($_POST['age']) && $_POST['age'] === '3') { echo 'checked';} ?>
                  >
                    30～39歳
                  </option>
                  <option 
                    value="4"   
                    <?php if (isset($_POST['age']) && $_POST['age'] === '4') { echo 'checked';} ?>
                  >
                    40～49歳
                  </option>
                  <option 
                    value="5" 
                    <?php if (isset($_POST['age']) && $_POST['age'] === '5') { echo 'checked';} ?>
                  >
                    50～59歳
                  </option>
                  <option 
                    value="6" 
                    <?php if (isset($_POST['age']) && $_POST['age'] === '6') { echo 'checked';} ?>
                  >
                    60歳～
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="contact">お問い合わせ内容</label>
                <textarea 
                  class="form-control" 
                  id="contact" 
                  row="3" 
                  name="contact"
                >
                  <?php if (!empty($_POST['contact'])) { echo h($_POST['contact']);} ?>
                </textarea>
              </div>
              <div class="form-check">
                <input 
                  class="form-check-input" 
                  id="caution" 
                  type="checkbox" 
                  name="caution" 
                  value="1"
                >
                <label 
                  for="form-check-label" 
                  for="caution"
                >
                  注意事項にチェックする
                </label>
              </div>

              <input 
                class="btn btn-info" 
                type="submit" 
                name="btn_confirm" 
                value="確認する"
              >
              <!-- $_POSTの['csrf']にtoken値追加 -->
              <input 
                type="hidden" 
                name="csrf" 
                value="<?php echo $token; ?>"
              >
            </form>
          </div> <!-- .col-md-6 -->
        </div> <!-- .row -->
      </div> <!-- .container -->
  <?php endif; ?>

  <!-- 確認画面 -->
  <?php if ($pageFlag === 1) : ?>
    <!-- $_SESSIONのトークンと$_POSTのトークンを比較
      $_POST(正しい"入力画面"でのみ得られる) -->
    <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
      <form method="POST" action="input.php">
        氏名
        <?php echo h($_POST['your_name']); ?>
        <br>
        メールアドレス
        <?php echo h($_POST['email']); ?>
        <br>
        ホームページ
        <input 
          type="url" 
          name="url" 
          value="<?php if (!empty($_POST['url'])) {echo h($_POST['url']);} ?>"
        >
        <br>
        性別
        <?php
        if ($_POST['gender'] === "0") {
          echo '男性';
        }
        if ($_POST['gender'] === "1") {
          echo '女性';
        }
        ?>
        年齢
        <?php
        if ($_POST['age'] === "1") {
          echo '～19歳';
        }
        if ($_POST['age'] === "2") {
          echo '20～29歳';
        }
        if ($_POST['age'] === "3") {
          echo '30～39歳';
        }
        if ($_POST['age'] === "4") {
          echo '40～49歳';
        }
        if ($_POST['age'] === "5") {
          echo '50～59歳';
        }
        if ($_POST['age'] === "6") {
          echo '60歳～';
        }
        ?>
        お問い合わせ内容
          <input 
            type="text" 
            name="contact" 
            value="<?php if (!empty($_POST['contact'])) {echo h($_POST['contact']);} ?>"
          >
          <br>
          <input type="submit" name="back" value="戻る">
          <input type="submit" name="btn_submit" value="送信する">
          <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
          <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
          <input type="hidden" name="url" value="<?php echo h($_POST['url']); ?>">
          <input type="hidden" name="gender" value="<?php echo h($_POST['gender']); ?>">
          <input type="hidden" name="age" value="<?php echo h($_POST['age']); ?>">
          <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">
          <!-- $_POSTの['csrf']にtoken値追加 -->
          <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
      </form>
    <?php endif; ?>

  <?php endif; ?>

  <!-- 完了画面 -->

  <?php if ($pageFlag === 2) : ?>
    <!-- $_SESSIONのトークンと$_POSTのトークンを比較
      $_POST(正しい"確認画面"でのみ得られる)     -->
    <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>

    <?php require '../mainte/insert.php'; 
      insertContact($_POST);
    ?>

      送信が完了しました。
      <!-- 完了画面表示と共にトークンを削除 -->
      <?php unset($_SESSION['csrfToken']); ?>
    <?php endif; ?>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>