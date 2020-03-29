<?php
require_once 'class/configDB.php';
class authClass extends configDataBase
{
    public function registrUser($login, $password) //метод добавления данных в бд
    {
        $pdo = $this->getConnect();
        $sql = 'INSERT INTO USERS (login, password) VALUES (:login, :password)';
        $query = $pdo->prepare($sql);
        $query->execute(['login' => trim(htmlspecialchars($login, ENT_QUOTES)), 'password' => password_hash(htmlspecialchars($password), PASSWORD_DEFAULT)]);
    }

    public function getUser($login, $password) //метод проверки наличия юзера перед авторизации
    {
        $pdo = $this->getConnect();
        $query = $pdo->query('SELECT * FROM USERS');
        while ($row = $query->fetch(PDO::FETCH_OBJ))
        {
            if ($login == $row->login && password_verify($password, $row->password))
            {
                $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным если запись в БД есть
                $_SESSION["login"] = $row->login; //Записываем в сессию логин пользователя
                break;
                return true;
            }
            else
            {
                $_SESSION["err_auth"] = 'Не верно введен логин или пароль'; //формируем ошибку для возврата пользователю
            }
        }
        if (!isset( $_SESSION["is_auth"]))
        {
            $_SESSION["is_auth"] = false;
            return false;
        }
    }
    public function isAuth()
    {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
}