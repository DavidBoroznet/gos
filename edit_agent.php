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

    // Проверка, была ли отправлена форма для сохранения изменений
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $virsta = $_POST['virsta'];
        $telefon = $_POST['telefon'];

        // Подготовка и выполнение SQL-запроса на обновление данных агента
        $updateQuery = "UPDATE agent SET nume = '$nume', prenume = '$prenume', virsta = '$virsta', telefon = '$telefon' WHERE CodAgent = '$CodAgent'";
        if ($mysqli->query($updateQuery)) {
            // Перенаправление на страницу со списком агентов
            header("Location: agents.php");
            exit();
        } else {
            echo "Ошибка при обновлении данных агента: " . $mysqli->error;
        }
    }

    // Получение данных агента из базы данных
    $selectQuery = "SELECT * FROM agent WHERE CodAgent = '$CodAgent'";
    $result = $mysqli->query($selectQuery);
    $agent = $result->fetch_assoc();

    // Закрытие соединения с базой данных
    $mysqli->close();
} else {
    // Если параметр CodAgent отсутствует или пустой, перенаправляем на страницу со списком агентов
    header("Location: agents.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактирование агента</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Редактирование агента</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nume">Имя:</label>
                <input type="text" class="form-control" id="nume" name="nume" value="<?php echo $agent['nume']; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenume">Фамилия:</label>
                <input type="text" class="form-control" id="prenume" name="prenume" value="<?php echo $agent['prenume']; ?>" required>
            </div>
            <div class="form-group">
                <label for="virsta">Возраст:</label>
                <input type="number" class="form-control" id="virsta" name="virsta" value="<?php echo $agent['virsta']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefon">Телефон:</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $agent['telefon']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
