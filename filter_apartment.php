<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Список квартир</title>
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
            <div class="back-button-wrapper">
                <a href="index.html" class="btn btn-primary back-button float-right">Назад</a>
            </div>
            <br>
            <h1>Список четырехкомнатных квартир на 2 и 3 этажах</h1>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Код квартиры</th>
                            <th>Этаж</th>
                            <th>Количество комнат</th>
                            <th>Цена</th>
                            <th>Площадь</th>
                            <th>Код агента</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Подключение к базе данных
                        $mysqli = new mysqli("localhost", "root", "", "Apartamente");
                        if ($mysqli->connect_errno) {
                            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
                        }

                        // Подготовка и выполнение SQL-запроса для поиска квартир
                        $query = "SELECT * FROM Apartament WHERE nrCamere = 4 AND (etaj = 2 OR etaj = 3)";
                        $result = $mysqli->query($query);

                        // Проверка наличия результатов
                        if ($result->num_rows > 0) {
                            // Вывод списка квартир
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['CodApartament'] . "</td>";
                                echo "<td>" . $row['etaj'] . "</td>";
                                echo "<td>" . $row['nrCamere'] . "</td>";
                                echo "<td>" . $row['Pret'] . "</td>";
                                echo "<td>" . $row['metriPatrati'] . "</td>";
                                echo "<td>" . $row['CodAgent'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Нет результатов.</td></tr>";
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
