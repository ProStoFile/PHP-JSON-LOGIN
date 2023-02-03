<?php require("login.class.php") ?>
<?php
if (isset($_POST['submit'])) {
    $user = new LoginUser($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Log in form</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-header">
        <h2>Авторизация</h2>
        <h4>Все поля <span>обязательны</span></h4>
    </div>

    <label>Имя пользователя</label>
    <input type="text" name="username">

    <label>Пароль</label>
    <input type="text" name="password">

    <button type="submit" name="submit">Авторизоваться</button>

    <p class="error"><?php echo @$user->error ?></p>
    <p class="success"><?php echo @$user->success ?></p>

    <div class="userInfoMessage">
        <p>Нет аккаунта?</p>
        <a href="index.php">Зарегистрироваться</a>
    </div>

</form>

</body>
</html>