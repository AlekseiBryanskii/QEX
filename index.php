<?php
require_once 'class/authClass.php'; //подключаем класс авторизации
session_start(); //начинаем сессию
$authUser = new authClass(); //создаем экземпляр класса
if (isset($_POST['login']) && isset($_POST['password1'])) //проверяем данные
{
    $authUser->setConnect('localhost','qex','root',''); //устанавливаем соединение с БД
    $authUser->getUser($_POST['login'], $_POST['password1']); //ищем пользователя в БД
}

if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода, функция Logout
    if ($_GET["is_exit"] == 1) {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
        header("Location: ?is_exit=0"); //Редирект после выхода
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
</head>
<body>

<?php require "blocks/header.php" ?> <!-- подключаем header -->

<?php
    if ($authUser->isAuth())
        { // Если пользователь авторизован, приветствуем:
            echo "<h4 align='center'>Здравствуйте, " . $_SESSION["login"] . "</h4>";

        }
    else
        { //Если не авторизован, показываем форму ввода логина и пароля
?>

<div class="container mt-5" >

    <form action="" method="post" style="width: 300px;">
        <h3>Авторизация</h3>
        <div class="form-group">
            <label>Логин</label>
            <input type="text" name="login" placeholder="Введите логин" class="form-control">
            <span id="error_login" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password1" class="form-control" placeholder="Введите пароль"></input>
            <span id="error_login" class="text-danger"></span>
        </div>
        <div class="form-group">
            <button type="submit" name="send" class="btn btn-success" style="width: 100px">Войти</button>
            <button onclick='document.location="http://127.0.0.1:8081/QEX/regist.php"' type="button" class="btn btn-primary" style="width: 195px">Зарегистрироваться</button>
        </div>
        <!-- выводим ошибку авторизации, данные об куспехе находятся в сессии -->
        <?php if (isset($_SESSION['err_auth']) && isset($_POST['login'])) {?><div class="alert alert-danger" role="alert"><?php echo $_SESSION['err']?></div><?php } ?>

    </form>
</div>

<?php } ?>
</body>
</html>