<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Тестовое задание QEX</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="http://127.0.0.1:8081/QEX/zadan2.php">Задание №2</a>
    </nav>
    <?php
        if(isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] == true)
        {
            echo '<a class="btn btn-outline-primary" href="http://127.0.0.1:8081/QEX/index.php?is_exit=1">'. $_SESSION["login"] .', выйти</a>';
        }
        else
            echo '<a class="btn btn-outline-primary" href="http://127.0.0.1:8081/QEX/index.php">Авторизироваться</a>';
    ?>
</div>