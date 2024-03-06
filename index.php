<?php
include("./data/database.php");
session_start();
$user_id = $_SESSION["user_id"];


if (!isset($_SESSION["user_id"])) {
    // Redirect the user to the login page if not logged in



    header("Location: LogIn.php");
    exit; // Stop further execution
}
if (isset($_POST["out"])) {
    session_unset();
    session_destroy();
    header("Location: LogIn.php");
    exit;
}

$car_license = "";

if (isset($_POST["car_add_but"])) {
    $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $coupe = filter_input(INPUT_POST, 'coupe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $license = filter_input(INPUT_POST, 'license', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $engine = filter_input(INPUT_POST, 'engine', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hp = filter_input(INPUT_POST, 'hp', FILTER_VALIDATE_INT);
    $wheels = filter_input(INPUT_POST, 'wheels', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cubic = filter_input(INPUT_POST, 'cubic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gearbox = filter_input(INPUT_POST, 'gearbox', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tyres = filter_input(INPUT_POST, 'tyres', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $km = filter_input(INPUT_POST, 'kilometers', FILTER_VALIDATE_INT);
    $oil = filter_input(INPUT_POST, 'oil', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try {
        $stmt = $conn->prepare("INSERT INTO Static_Data (license, car_owner, brand, model, coupe, type_engine, hp, wheels, tyres, oil_type, production_year, gearbox, cubic, kilometers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissssisssssdi", $license, $user_id, $brand, $model, $coupe, $engine, $hp, $wheels, $tyres, $oil, $year, $gearbox, $cubic, $km);
        if ($stmt->execute()) {
            // Redirect after successful form submission
            echo "Car added successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="index.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- header -->
    <?php include("./functions/header.php"); ?>

    <?php include "./functions/carChoose.php"; ?>

    <section>
        <!-- left menu -->
        <div id="left_menu">

            <button class="but">Коли</button>
            <button class="but" name="cons" id="consButton" value="">Консумативи</button>
            <button class="but">Ремонти</button>
            <button class="but">Сервизи</button>
        </div>
        <!-- add car -->
        <div id="div_right">
            <form id="car_add" method="POST" style="display: none;">
                <button type="button" class="close" onclick="closeForm()">x</button>
                <label class="addLabel" for="brand">Марка:</label>
                <input class="addInput" id="brand" type="text" name="brand">
                <br>
                <label class="addLabel" for="model">Модел:</label>
                <input class="addInput" id="model" type="text" name="model">
                <br>
                <label class="addLabel" for="coupe">Категория:</label>
                <input type="text" class="addInput" id="coupe" name="coupe">
                <br>
                <label for="year" class="addLabel" id="yearLabel">Година:</label>
                <input type="text" class="addInput" id="year" name="year">
                <br>
                <label for="license" class="addLabel" id="licenseLabel">Регистрационен номер:</label>
                <input type="text" class="addInput" id="license" name="license">
                <br>
                <label for="engine" class="addLabel" id="engineLabel">Двигател</label>
                <select id="engine" name="engine">
                    <option value="Бензин">Бензин</option>
                    <option value="Бензин с газ">Бензин с газ</option>
                    <option value="Дизел">Дизел</option>
                    <option value="Електрически">Електрически</option>
                    <option value="Хибриден">Хибриден</option>
                </select>
                <br>
                <label class="addLabel" for="hp">Мощност [к.с.]:</label>
                <input type="text" class="addInput" id="hp" name="hp">
                <br>
                <label class="addLabel" for="cubic">Кубатура [куб.м]:</label>
                <input type="text" class="addInput" id="cubic" name="cubic">
                <br>
                <label class="addLabel" for="gearbox" id="gearboxLabel">Скоростна кутия</label>
                <select id="gearbox" name="gearbox">
                    <option value="Ръчна">Ръчна</option>
                    <option value="Автоматична">Автоматична</option>
                </select>
                <br>
                <label class="addLabel" for="wheels">Големина джанти [R]:</label>
                <input type="text" class="addInput" id="wheels" name="wheels">
                <br>
                <label class="addLabel" for="tyres">Големина гуми [широчина/процент от широчината/R]:</label>
                <input type="text" class="addInput" id="tyres" name="tyres">
                <br>
                <label class="addLabel" for="kilometers">Пробег [км]:</label>
                <input type="text" class="addInput" id="kilometers" name="kilometers">
                <br>
                <label class="addLabel" for="oil">Вид на маслото:</label>
                <input type="text" class="addInput" id="oil" name="oil">
                <br>
                <input type="submit" id="car_add_but" name="car_add_but" value="Добави">
            </form>

            <form id="carInfoForm" action="index.php" method="POST">
                <?php
                if (isset($_POST['license'])) {
                    $license = $_POST['license'];

                    //$actionUrl = "index.php?license=" . urlencode($license);

                    $sql = "SELECT * FROM static_data WHERE license = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $license);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $row = $result->fetch_assoc();

                    // Output the car information within the form
                    echo '<label for="brand">Марка: ' . $row["brand"] . '</label><br>';
                    echo '<label for="model">Модел: ' . $row["model"] . '</label><br>';
                    echo '<label for="coupe">Категория: ' . $row["coupe"] . '</label><br>';
                    echo '<label for="year">Година: ' . $row["production_year"] . '</label><br>';
                    echo '<label for="license">Регистрационен номер: <span id="span_license">' . $row["license"] . '</span></label><br>';
                    echo '<label for="engine">Двигател: ' . $row["type_engine"] . '</label><br>';
                    echo '<label for="hp">Мощност [к.с.]: ' . $row["hp"] . '</label><br>';
                    echo '<label for="cubic">Кубатура [куб.м]: ' . $row["cubic"] . '</label><br>';
                    echo '<label for="gearbox">Скоростна кутия: ' . $row["gearbox"] . '</label><br>';
                    echo '<label for="wheels">Големина джанти [R]: ' . $row["wheels"] . '</label><br>';
                    echo '<label for="tyres">Големина гуми [широчина/процент от широчината/R]: ' . $row["tyres"] . '</label><br>';
                    echo '<label for="kilometers">Пробег [км]: ' . $row["kilometers"] . '</label><br>';
                    echo '<label for="oil">Вид на маслото: ' . $row["oil_type"] . '</label><br>';
                }
                ?>
                <input type="hidden" id="licenseInput" name="license">

            </form>

            <form id="consumesForm" action="index.php" method="POST">
                <?php
                if (isset($_POST['consumesName'])) {
                    $car = $_POST['consumesName'];
                    echo $car;
                    // Query to retrieve comsumes information for the selected car
                    $sql = "SELECT * FROM consumes WHERE car = 'CA7672AB'";
                    $stmt = $conn->prepare($sql);
                    //$stmt->bind_param("s", $car);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if any results are returned
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<label>Consume Type: ' . $row["consume_type"] . '</label><br>';
                            echo '<label>Date: ' . $row["date"] . '</label><br>';
                            echo '<label>Kilometers: ' . $row["kilometers"] . '</label><br>';
                            echo '<label>Description: ' . $row["description"] . '</label><br>';
                            echo '<label>Price: ' . $row["price"] . '</label><br>';
                            echo '<hr>'; // Add a horizontal line to separate comsumes
                        }
                    } else {
                        echo "No consumes found for the selected car.";
                    }
                }

                ?>
                <input type="hidden" id="consumeInput" name="consumesName">
            </form>

            <!-- <label>Вид консуматив:</label>
                <label>Вид консуматив: </label>
                <label>Вид консуматив: </label>
                <label>Вид консуматив: </label>
                <label>Вид консуматив: </label>
                <label>Вид консуматив: </label>
                <label>Вид консуматив: </label> -->

            </form>
            <!-- <script>
        $(document).ready(function(){
            $('#span_license').on('change', function(){
                var license = $(this).text();
                $.ajax({
                    type: 'POST',
                    url: 'fetch_data.php',
                    data: {license: license},
                    success: function(data){
                        $('#consumes').html(data);
                    }
                });
            });
        });
    </script> -->

        </div>
    </section>

    <!-- footer -->
    <footer>
        <h2>Контакти на админ</h2>
        <p>Телефон: 0882739564</p>
        <p>E-mail: v.dupinov@gmail.com</p>
    </footer>
    <script src="index.js"></script>
</body>

</html>