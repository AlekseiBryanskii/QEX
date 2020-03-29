<?php
require_once 'class/authClass.php';
$reg = new authClass(); //создаем экземпляр класса
if (isset($_POST['login']) && isset($_POST['password1']) && isset($_POST['password2'])) //проверяем наличие отправленных данных
{
    if ($_POST['password1'] == $_POST['password2']) //проверяем что пароли совпадают
    {
        $reg->setConnect('localhost','qex','root','');//создаем соединение с бд данные метод унаследован от класса configDB
        $reg->registrUser($_POST['login'], $_POST['password1']); //создаем запись в БД
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Сайт на PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<?php require "blocks/header.php" ?> <!-- подключаем заголовок который повторяется -->
<div class="container mt-5" >
    <h3>Регистрация</h3>
    <form action="" method="post" id="regform" style="width: 300px;">
        <div class="form-group">
            <label>Логин</label>
            <input id="login" type="text" name="login" placeholder="Введите логин" class="form-control">
            <span id="error_login" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input id="password1" type="password" name="password1" class="form-control" placeholder="Введите пароль"></input>
            <span id="error_password1" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Подтвердите пароль</label>
            <input id="password2" type="password" name="password2" class="form-control" placeholder="Введите пароль еще раз"></input>
            <span id="error_password2" class="text-danger"></span>
        </div>
        <div class="form-group">
            <button type="submit" name="send" class="btn btn-success">Зарегистрироваться</button>
        </div>

    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

<script src="javascript/validate.js"></script>
</body>
</html>