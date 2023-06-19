<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "Apartamente");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

// Переменные для хранения данных формы
$nume = $prenume = $virsta = $telefon = "";
$errors = array();

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка и очистка данных формы
    $nume = cleanInput($_POST["nume"]);
    $prenume = cleanInput($_POST["prenume"]);
    $virsta = cleanInput($_POST["virsta"]);
    $telefon = cleanInput($_POST["telefon"]);

    // Валидация данных
    if (empty($nume)) {
        $errors[] = "Введите фамилию агента";
    }

    if (empty($prenume)) {
        $errors[] = "Введите имя агента";
    }

    if (empty($virsta)) {
        $errors[] = "Введите возраст агента";
    }

    if (empty($telefon)) {
        $errors[] = "Введите телефон агента";
    }

    // Если нет ошибок, добавляем агента в базу данных
    if (empty($errors)) {
        // Подготовка и выполнение SQL-запроса на добавление агента
        $insertQuery = "INSERT INTO agent (nume, prenume, virsta, telefon) VALUES ('$nume', '$prenume', '$virsta', '$telefon')";
        if ($mysqli->query($insertQuery)) {
            // Перенаправление на страницу со списком агентов
            header("Location: agents.php");
            exit();
        } else {
            echo "Ошибка при добавлении агента: " . $mysqli->error;
        }
    }
}

// Функция для очистки данных формы
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Закрытие соединения с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить агента</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавить агента</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nume">Фамилия:</label>
                <input type="text" class="form-control" id="nume" name="nume" value="<?php echo $nume; ?>">
            </div>
            <div class="form-group">
                <label for="prenume">Имя:</label>
                <input type="text" class="form-control" id="prenume" name="prenume" value="<?php echo $prenume; ?>">
            </div>
            <div class="form-group">
                <label for="virsta">Возраст:</label>
                <input type="text" class="form-control" id="virsta" name="virsta" value="<?php echo $virsta; ?>">
            </div>
            <div class="form-group">
                <label for="telefon">Телефон:</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $telefon; ?>">
            </div>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
