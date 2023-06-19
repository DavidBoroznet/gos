<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "Apartamente");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

// Проверка, если форма была отправлена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $etaj = $_POST["etaj"];
    $nrCamere = $_POST["nrCamere"];
    $pret = $_POST["pret"];
    $metriPatrati = $_POST["metriPatrati"];
    $codAgent = $_POST["codAgent"];

    // Подготовка и выполнение SQL-запроса на добавление квартиры
    $insertQuery = "INSERT INTO Apartament (etaj, nrCamere, Pret, metriPatrati, CodAgent) 
                    VALUES ('$etaj', '$nrCamere', '$pret', '$metriPatrati', '$codAgent')";
    if ($mysqli->query($insertQuery)) {
        // Перенаправление на страницу со списком квартир
        header("Location: apartments.php");
        exit();
    } else {
        echo "Ошибка при добавлении квартиры: " . $mysqli->error;
    }
}

// Закрытие соединения с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить квартиру</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавить квартиру</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="etaj">Этаж:</label>
                <input type="text" class="form-control" id="etaj" name="etaj" required>
            </div>
            <div class="form-group">
                <label for="nrCamere">Количество комнат:</label>
                <input type="text" class="form-control" id="nrCamere" name="nrCamere" required>
            </div>
            <div class="form-group">
                <label for="pret">Цена:</label>
                <input type="text" class="form-control" id="pret" name="pret" required>
            </div>
            <div class="form-group">
                <label for="metriPatrati">Площадь:</label>
                <input type="text" class="form-control" id="metriPatrati" name="metriPatrati" required>
            </div>
            <div class="form-group">
                <label for="codAgent">Код агента:</label>
                <input type="text" class="form-control" id="codAgent" name="codAgent" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
