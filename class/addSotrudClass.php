<?php

require_once 'class/configDB.php';
class addSotrudClass extends configDataBase
{
    public function addSotrud($fio, $doljnost, $about)
    {
        $pdo = $this->getConnect(); //получаем соединение с БД
        $sql = 'INSERT INTO SOTRUDNIKI (fio, doljnost, about_sotrud) VALUES (:fio, :doljnost, :about)';
        $query = $pdo->prepare($sql);
        //перед добалением данных убираем лишние пробелы, и проверяем на спецсимволы HTML
        $query->execute(['fio' => trim(htmlspecialchars($fio, ENT_QUOTES)), 'doljnost' => trim(htmlspecialchars($doljnost, ENT_QUOTES)), 'about' => trim(htmlspecialchars($about, ENT_QUOTES))]);


    }

    public function getDataSotrud($count)
    {
        //формируем таблицу для передачи
        echo
        '<table class="table table-sm table-dark" border="1">
            <thead >
                <tr>
                    <th>№</th>
                    <th>ФИО сотрудника</th>
                    <th>Должность</th>
                    <th>Данные о сотруднике</th>                    
                </tr>
            </thead>
        <tbody>';
        $pdo = $this->getConnect();
        $sql = "SELECT * FROM SOTRUDNIKI ORDER BY id DESC LIMIT " .$count."";
        $query = $pdo->query($sql);
        //$query = $pdo->query('SELECT * FROM SOTRUDNIKI ORDER BY id DESC LIMIT 20');
        while ($row = $query->fetch(PDO::FETCH_OBJ))
        {
            echo '<tr>' .
                    '<td>' . $row->id  . '</td>' .
                    '<td>' . $row->fio . '</td>' .
                    '<td>' . $row->doljnost . '</td>' .
                    '<td>' . $row->about_sotrud .'</td>' .
                '</tr>';
        }
        echo '
        </tbody>
        </table>		
';
    }
}