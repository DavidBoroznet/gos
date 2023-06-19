<!DOCTYPE html>
<html>
<head>
    <title>Apartamente</title>
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
    <h2>Агенты</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Код Агента</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Возраст</th>
            <th>Телефон</th>
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

        // Получение данных из таблицы "Agent"
        $query = "SELECT * FROM Agent";
        $result = $mysqli->query($query);

        // Отображение данных в таблице
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CodAgent'] . "</td>";
            echo "<td>" . $row['nume'] . "</td>";
            echo "<td>" . $row['prenume'] . "</td>";
            echo "<td>" . $row['virsta'] . "</td>";
            echo "<td>" . $row['telefon'] . "</td>";
            echo "<td>";
            echo "<a href='edit_agent.php?CodAgent=" . $row['CodAgent'] . "' class='btn btn-primary btn-sm'>Редактировать</a>";
            echo "<a href='delete_agent.php?CodAgent=" . $row['CodAgent'] . "' class='btn btn-danger btn-sm'>Удалить</a>";
            echo "</td>";
            echo "</tr>";
        }

        // Закрытие соединения с базой данных (можно использовать тот же объект $mysqli)
        $mysqli->close();
        ?>
        </tbody>
    </table>
 </div>
    <a href="add_agent.php" class="btn btn-success">Добавить агента</a> <!-- Добавляем кнопку "Добавить агента" -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>