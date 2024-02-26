<!-- <?php
// include("database.php");
// session_start();

// if (isset($_POST["out"])) {
//     session_unset();
//     session_destroy();
//     header("Location: LogIn.php");
//     exit;
// }
// $user_id=$_SESSION["user_id"];
// echo $user_id;

// if(isset($_POST["car_add_but"])){
//     // Step 1: Retrieve the logged-in user's ID from the session
//     $user_id=$_SESSION["user_id"]; // Set the user ID after successful login
//     // Step 2: Retrieve the form data
//     $brand = $_POST["brand"];
//     $model = $_POST['model'];
//     $coupe = $_POST['coupe'];
//     $year = $_POST['year'];
//     $license = $_POST['license'];
//     $engine = $_POST['engine'];
//     $hp = $_POST['hp'];
//     $wheels = $_POST['wheels'];
//     $cubic = $_POST['cubic'];
//     $gearbox = $_POST['gearbox'];
//     $tyres = $_POST['tyres'];
//     $km = $_POST['kilometers'];
//     $oil = $_POST['oil'];

//     // Step 3: Prepare and execute the SQL INSERT statement
//     $stmt = $conn->prepare("INSERT INTO Static_Data (license, car_owner, brand, model, coupe, type_engine, hp, wheels, tyres, oil_type, production_year, gearbox, cubic, kilometers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("sissssisssssdi", $license, $user_id, $brand, $model, $coupe, $type_engine, $hp, $wheels, $tyres, $oil, $year, $gearbox, $cubic, $km);
//     if ($stmt->execute()) {
//         echo "Car added successfully";
//     } else {
//         echo "Error: " . $conn->error;
//     }

//     $stmt->close();
// }


?> -->

<?php
include("database.php");
session_start();

if (isset($_POST["out"])) {
    session_unset();
    session_destroy();
    header("Location: LogIn.php");
    exit;
}

$user_id = $_SESSION["user_id"];

if(isset($_POST["car_add_but"])){
    $user_id = $_SESSION["user_id"];
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

    $stmt = $conn->prepare("INSERT INTO Static_Data (license, car_owner, brand, model, coupe, type_engine, hp, wheels, tyres, oil_type, production_year, gearbox, cubic, kilometers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssisssssdi", $license, $user_id, $brand, $model, $coupe, $engine, $hp, $wheels, $tyres, $oil, $year, $gearbox, $cubic, $km);
    if ($stmt->execute()) {
        echo "Car added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
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
    <header>
        <form method="POST">
        <?php 
        echo '<h1 class="username">' . $_SESSION["username"] . '</h1>';
        ?>
            <button id="logoutbutton" type="submit" name="out">Log out</button>  
        </form>
        <button id="add_car" onclick="addForm()">Добави автомобил </button>
    </header>

    <div id="car_choose">
        <button>Ford Fiesta</button>
        <button>Ford Fiesta</button> 
    </div>
    <section>
        <!-- left menu -->
        <div id="left_menu">

            <button class="but">Cars</button>
            <button class="but">Comsumes</button>
            <button class="but">Repairs</button>
            <button class="but">Repair shops</button>
        </div>
    <!-- add car -->
        <div id="div_right">
        <form id="car_add" method="POST" style="display: none;">
            <button class="close">x</button>
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