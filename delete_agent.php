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

    // Подготовка и выполнение SQL-запроса на удаление всех квартир, привязанных к агенту
    $deleteApartmentsQuery = "DELETE FROM Apartament WHERE CodAgent = '$CodAgent'";
    if ($mysqli->query($deleteApartmentsQuery)) {
        // Подготовка и выполнение SQL-запроса на удаление агента
        $deleteAgentQuery = "DELETE FROM agent WHERE CodAgent = '$CodAgent'";
        if ($mysqli->query($deleteAgentQuery)) {
            // Перенаправление на страницу со списком агентов
            header("Location: agents.php");
            exit();
        } else {
            echo "Ошибка при удалении агента: " . $mysqli->error;
        }
    } else {
        echo "Ошибка при удалении квартир: " . $mysqli->error;
    }
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
