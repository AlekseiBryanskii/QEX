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
<?php require "blocks/header.php" ?> <!-- подключаем заголовок который повторяется -->
<div class="container mt-5" >
    <form id="addSotrud" method="post" style="width: 500px;">
        <h3>Добавить данные о сотруднике</h3><br>
        <div class="form-group">
            <label>ФИО сотрудника</label>
            <input type="text" name="fio" placeholder="Введите ФИО сотрудника" class="form-control">
            <span id="error_fio" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Должность</label>
            <select name="doljnost" class="form-control">
                <option disabled selected>Выберите должность</option>
                <option>Администратор</option>
                <option>Страший менеджер</option>
                <option>Менеджер</option>
            </select>
            <span id="error_doljnost" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Данные о сотруднике</label>
            <textarea name="about" placeholder="Введите информацию о сотруднике" class="form-control"></textarea>
            <span id="error_about" class="text-danger"></span>
        </div>
        <div class="form-group">
            <button type="submit" name="send" class="btn btn-success" >Добавить запись</button>
        </div>
    </form>
    <div class="table-responsive"  id="dataSotrud">

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        var kolZap = 20; //переменная хранящее нужное количество подгружаемых строк из бд
        load_data(20); // вызываем функцию подгрузки даных из БД

        function load_data(count) //функция подгрузки даных из БД
        {
            $.ajax({
                url:"getDataSotrud.php",
                method:"POST",
                data: {count:count},
                success:function (data)
                {
                    $('#dataSotrud').html(data); //выводим в div данные
                }
            });
        }

        $('#addSotrud').on('submit', function(event) {//событие нажатия кнопки на форме
            event.preventDefault();
            var form_data = $(this).serialize();
            var count = 20;
            $.ajax({
                url:"getDataSotrud.php", // направляем данные запроса на исполнение
                method:"POST", // метод запроса
                data:form_data, count:count,// тут данные с формы
                success:function() // функция выполняется в случае успешной передачи
                {
                    load_data(count); //вызываем подгрузку данных из бд
                    $('#addSotrud')[0].reset(); // очищаем форму добавления сотрудника
                }
            });
        })

        window.onscroll =function () //собитые скролла
        {
            if($(window).scrollTop() == $(document).height()-$(window).height()) //проверяем нахождение внизу страницы
            {
                kolZap+= 20; //добавляем для загрузки еще 20 записей
                $.ajax({
                    url:"getDataSotrud.php", // направляем данные запроса на исполнение
                    method:"POST", // метод запроса
                    data:{kolZap:kolZap},// тут данные с формы
                    success:function() // функция выполняется в случае успешной передачи
                    {
                        load_data(kolZap); //вызываем подгрузку данных
                    }
                });
            }
        }


    })


</script>
</body>
</html>