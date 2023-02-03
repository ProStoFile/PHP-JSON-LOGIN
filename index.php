<?php require("register.class.php") ?>
<?php
if (isset($_POST['submit'])) {
    $user = new RegisterUser($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/assets/css/styles.css'>
    <title>Register form</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-header">
        <h2>Регистрация</h2>
        <h4>Все поля <span>обязательны</span></h4>
    </div>

    <label>Имя пользователя</label>
    <input type="text" name="username">

    <label>Пароль</label>
    <input type="text" name="password">

    <button type="submit" name="submit">Зарегистрироваться</button>

    <p class="error"><?php echo @$user->error ?></p>
    <p class="success"><?php echo @$user->success ?></p>

    <div class="userInfoMessage">
        <p>Уже есть аккаунт? </p>
        <a href="login.php">Авторизоваться</a>
    </div>

</form>

</body>
</html>