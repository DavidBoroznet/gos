<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Список агентов</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .container {
            margin-top: 50px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button {
            font-size: 18px;
            padding: 8px 16px;
        }

        .table-wrapper {
            position: relative;
        }

        .back-button-wrapper {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: -30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="back-button-wrapper text-right">
                <a href="index.html" class="btn btn-primary back-button">Назад</a>
            </div>
            <h1>Список агентов с номером телефона в возрасте от 20 до 30 лет</h1>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Номер телефона</th>
                            <th>Возраст</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Подключение к базе данных
                        $mysqli = new mysqli("localhost", "root", "", "Apartamente");
                        if ($mysqli->connect_errno) {
                            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
                        }

                        // Подготовка и выполнение SQL-запроса для поиска агентов
                        $query = "SELECT * FROM agent WHERE virsta BETWEEN 20 AND 30 AND telefon IS NOT NULL";
                        $result = $mysqli->query($query);

                        // Проверка наличия результатов
                        if ($result->num_rows > 0) {
                            // Вывод списка агентов
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['nume'] . "</td>";
                                echo "<td>" . $row['prenume'] . "</td>";
                                echo "<td>" . $row['telefon'] . "</td>";
                                echo "<td>" . $row['virsta'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Нет результатов.</td></tr>";
                        }

                        // Закрытие соединения с базой данных
                        $mysqli->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>