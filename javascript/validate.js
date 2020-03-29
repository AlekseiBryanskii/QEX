$(document).ready(function(){
    $('#regform').on('submit', function(event){
        event.preventDefault();
        var error_login = ''; // обьявляем значения переменных об ошибках на форме
        var error_password1 = '';
        var error_password2 = '';
        if($('#login').val() == '') //проверка на заполненость поля Здание
        {
            error_login = 'Введите логин';
            $('#error_login').text(error_login); //выводим сообщение в элемент span об ошибке
            $('#login').css('border-color', '#cc0000'); // делаем границу поля красным для указания поля в котором совершена ошибка
        }
        else
        {
            error_login = '';
            $('#error_login').text(error_login); // удаляем значение в span
            $('#login').css('border-color', ''); // возвращаем в исходное состояние
        }
        if ($('#password1').val().length < 4 || $('#password1').val() != $('#password2').val() )
        {
            if ($('#password1').val() != $('#password2').val())
            {
                error_password1 = 'Пароли не совпадают';
                $('#error_password1').text(error_password1);
                $('#password1').css('border-color', '#cc0000');
                error_password2 = 'Пароли не совпадают';
                $('#error_password2').text(error_password2);
                $('#password2').css('border-color', '#cc0000');
            }
            if ($('#password1').val().length < 4)
            {
                error_password1 = 'Пароль должен быть не менее 4х символов';
                $('#error_password1').text(error_password1);
                $('#password1').css('border-color', '#cc0000');
            }
        }
        else
        {
            error_password1 = '';
            $('#error_password1').text(error_password1);
            $('#password1').css('border-color', '');
            error_password2 = '';
            $('#error_password2').text(error_password2);
            $('#password2').css('border-color', '');
        }

        if(error_login != '' || error_password1 != '' || error_password2 != '' ) // если какой-то из элементов с ошибками то ничего не делаем
        {
            return false;
        }
        else
        {  // если поьзователь заполнил правильно то
            var form_data = $(this).serialize(); // собираем данные с формы
            $.ajax({
                url:"", // направляем данные запроса на исполнение
                method:"POST", // метод запроса
                data:form_data, // тут данные с формы
                success:function() // функция выполняется в случае успешной передачи
                {
                    $('form[id =regform]').trigger('reset');
                    alert('Вы успешно зарегистрированы, авторизируйтесь на сайте'); //выводим сообщение об успешной авторизации
                    setTimeout(function(){ window.location = 'http://127.0.0.1:8081/QEX/index.php'; }, 1000); //редирект по истечении времени на страницу авторизации
                }
            });
        }

    });
});