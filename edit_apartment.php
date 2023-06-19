<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "Apartamente");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

// Проверка, если передан параметр "CodApartament" в URL
if (isset($_GET['CodApartament'])) {
    $codApartament = $_GET['CodApartament'];

    // Получение данных о квартире из базы данных
    $query = "SELECT * FROM Apartament WHERE CodApartament = '$codApartament'";
    $result = $mysqli->query($query);

    // Проверка, если квартира с указанным кодом существует
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Обработка формы редактирования
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из формы
            $etaj = $_POST['etaj'];
            $nrCamere = $_POST['nrCamere'];
            $pret = $_POST['pret'];
            $metriPatrati = $_POST['metriPatrati'];
            $codAgent = $_POST['codAgent'];

            // Обновление данных о квартире в базе данных
            $updateQuery = "UPDATE Apartament SET etaj = '$etaj', nrCamere = '$nrCamere', Pret = '$pret', metriPatrati = '$metriPatrati', CodAgent = '$codAgent' WHERE CodApartament = '$codApartament'";
            if ($mysqli->query($updateQuery)) {
                // Перенаправление на страницу со списком квартир
                header("Location: apartments.php");
                exit();
            } else {
                echo "Ошибка при обновлении данных: " . $mysqli->error;
            }
        }

        // Вывод формы редактирования
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Редактировать квартиру</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
        <div class="container">
            <h2>Редактировать квартиру</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="etaj">Этаж:</label>
                    <input type="text" class="form-control" id="etaj" name="etaj" value="<?php echo $row['etaj']; ?>">
                </div>
                <div class="form-group">
                    <label for="nrCamere">Количество комнат:</label>
                    <input type="text" class="form-control" id="nrCamere" name="nrCamere" value="<?php echo $row['nrCamere']; ?>">
                </div>
                <div class="form-group">
                    <label for="pret">Цена:</label>
                    <input type="text" class="form-control" id="pret" name="pret" value="<?php echo $row['Pret']; ?>">
                </div>
                <div class="form-group">
                    <label for="metriPatrati">Площадь (кв. м):</label>
                    <input type="text" class="form-control" id="metriPatrati" name="metriPatrati" value="<?php echo $row['metriPatrati']; ?>">
                </div>
                <div class="form-group">
                    <label for="codAgent">Код агента:</label>
                    <input type="text" class="form-control" id="codAgent" name="codAgent" value="<?php echo $row['CodAgent']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Квартира не найдена.";
    }
} else {
    echo "Неверные параметры.";
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
