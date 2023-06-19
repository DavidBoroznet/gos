<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "Apartamente");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

// Проверка, если передан параметр "CodApartament" в URL
if (isset($_GET['CodApartament'])) {
    $codApartament = $_GET['CodApartament'];

    // Удаление квартиры из базы данных
    $deleteQuery = "DELETE FROM Apartament WHERE CodApartament = '$codApartament'";
    if ($mysqli->query($deleteQuery)) {
        // Перенаправление на страницу со списком квартир
        header("Location: apartments.php");
        exit();
    } else {
        echo "Ошибка при удалении квартиры: " . $mysqli->error;
    }
} else {
    echo "Неверные параметры.";
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
