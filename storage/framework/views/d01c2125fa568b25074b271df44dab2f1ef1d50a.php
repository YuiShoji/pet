<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class = login_wrap>
    <h1>Login</h1>
    <form id="loginForm" name="loginForm" action="" method="POST">
      <label for="usermail">◆メールアドレス</label><br><input type="text" id="usermail" name="usermail" placeholder="メールアドレスを入力" value="<?php if (!empty($_POST["usermail"])) {echo htmlspecialchars($_POST["usermail"], ENT_QUOTES);} ?>">
      <br>
    <label for="password">◆パスワード</label><br><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
    <br>
    <br>
    <input type="submit" id="login" name="login" value="ログイン">
  </form>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/login.blade.php ENDPATH**/ ?>