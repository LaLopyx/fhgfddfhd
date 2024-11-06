<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выбор автомобиля</title>
</head>
<body>
    <h2>Выберите автомобиль</h2>
    <form method="GET" action="index.php">
        <label for="brand">Марка автомобиля:</label>
        <select name="brand" id="brand" onchange="this.form.submit()">
            <option value="">Выберите марку</option>
            <?php
            // Подключение к базе данных
            $conn = new mysqli('localhost', 'root', 'root', 'car_database');
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }

            // Получение списка марок
            $result = $conn->query("SELECT id, name FROM CarBrands");
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_GET['brand']) && $_GET['brand'] == $row['id']) ? "selected" : "";
                echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        
        <?php if (isset($_GET['brand']) && $_GET['brand'] != ''): ?>
            <br><br>
            <label for="model">Модель автомобиля:</label>
            <select name="model" id="model">
                <option value="">Выберите модель</option>
                <?php
                // Получение списка моделей для выбранной марки
                $brand_id = $_GET['brand'];
                $model_result = $conn->query("SELECT id, name FROM CarModels WHERE brand_id = $brand_id");
                while ($model_row = $model_result->fetch_assoc()) {
                    echo "<option value='" . $model_row['id'] . "'>" . $model_row['name'] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Выбрать</button>
        <?php endif; ?>
    </form>

    <?php
    // Отображение выбранной марки и модели
    if (isset($_GET['brand']) && isset($_GET['model']) && $_GET['model'] != '') {
        $brand_id = $_GET['brand'];
        $model_id = $_GET['model'];

        // Получение названий марки и модели
        $brand_name = $conn->query("SELECT name FROM CarBrands WHERE id = $brand_id")->fetch_assoc()['name'];
        $model_name = $conn->query("SELECT name FROM CarModels WHERE id = $model_id")->fetch_assoc()['name'];

        echo "<p>Вы выбрали: $brand_name - $model_name</p>";
    }

    // Закрытие соединения
    $conn->close();
    ?>
</body>
</html>
