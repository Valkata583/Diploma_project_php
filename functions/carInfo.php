<?php

echo "<form id='carInfoForm' action='index.php' method='POST'>";
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

    // Save the car license in session
    $_SESSION['carLicense'] = $license;
}
echo "<input type='hidden' id='licenseInput' name='license'>";

echo "</form>";
?>
