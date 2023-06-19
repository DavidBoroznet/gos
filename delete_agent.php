<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "Apartamente");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

// Проверка наличия параметра CodAgent в URL
if (isset($_GET['CodAgent']) && !empty($_GET['CodAgent'])) {
    // Получение CodAgent из URL
    $CodAgent = $_GET['CodAgent'];

    // Подготовка и выполнение SQL-запроса на удаление агента
    $deleteQuery = "DELETE FROM agent WHERE CodAgent = '$CodAgent'";
    if ($mysqli->query($deleteQuery)) {
        // Перенаправление на страницу со списком агентов
        header("Location: agents.php");
        exit();
    } else {
        echo "Ошибка при удалении агента: " . $mysqli->error;
    }
}

// Закрытие соединения с базой данных
$mysqli->close();
?>