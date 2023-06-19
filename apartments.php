<!DOCTYPE html>
<html>
<head>
    <title>Apartaments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
            <div class="back-button-wrapper">
                <a href="index.html" class="btn btn-primary back-button">Назад</a>
            </div>
            <h2>Квартиры</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Код Квартиры</th>
                        <th>Этаж</th>
                        <th>Кол. комнат</th>
                        <th>Цена</th>
                        <th>Площадь (кв. м)</th>
                        <th>Код Агента</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Подключение к базе данных
                    $mysqli = new mysqli("localhost", "root", "", "Apartamente");
                    if ($mysqli->connect_errno) {
                        echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
                    }

                    // Получение данных из таблицы "Apartament"
                    $query = "SELECT * FROM Apartament";
                    $result = $mysqli->query($query);

                    // Отображение данных в таблице
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['CodApartament'] . "</td>";
                        echo "<td>" . $row['etaj'] . "</td>";
                        echo "<td>" . $row['nrCamere'] . "</td>";
                        echo "<td>" . $row['Pret'] . "</td>";
                        echo "<td>" . $row['metriPatrati'] . "</td>";
                        echo "<td>" . $row['CodAgent'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_apartment.php?CodApartament=" . $row['CodApartament'] . "' class='btn btn-primary btn-sm'>Редактировать</a>";
                        echo "<a href='delete_apartment.php?CodApartament=" . $row['CodApartament'] . "' class='btn btn-danger btn-sm'>Удалить</a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    // Закрытие соединения с базой данных
                    //$mysqli->close();
                    ?>
                </tbody>
            </table>
        </div>

        <a href="add_apartment.php" class="btn btn-success">Добавить квартиру</a> <!-- Добавляем кнопку "Добавить квартиру" -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
