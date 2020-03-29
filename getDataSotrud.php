<?php
require_once 'class/addSotrudClass.php';
$sotr = new addSotrudClass();
$sotr->setConnect('localhost', 'qex', 'root', '');//устанавливаем соединение с БД


if (isset($_POST['fio']) && isset($_POST['doljnost']) && isset($_POST['about'])) { //проверяем данные
    $sotr->addSotrud($_POST['fio'], $_POST['doljnost'],$_POST['about']);//добавляем данные в бд
}
$sotr->getDataSotrud($_POST['count']);//получаем записи о сотрудниках из БД

