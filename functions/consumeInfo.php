<?php

// Check if 'carLicense' is set in the session
if (isset($_SESSION['carLicense'])) {
    // Access the 'carLicense' from the session
    $car_license = $_SESSION['carLicense'];
    $sql = "SELECT consumes.*, repair_shop.name_repair_shop FROM consumes LEFT JOIN repair_shop ON consumes.repair_shop = repair_shop.id WHERE car=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $car_license);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<div id=consInfo style='display: none;'>";
    while ($row = $result->fetch_assoc()) {
        // Now you can use $car_license wherever you need it
        $type=$row["consume_type"];
        $date=$row["date_cons"];
        $km=$row["kilometers"];
        $description=$row["description_cons"];
        $name = $row["name_repair_shop"];
        $price = $row["price"];
        echo "<label>Вид на ремонта: $type </label><br>";
        echo "<label>Описание: $description </label><br>";
        echo "<label>Километри: $km </label><br>";
        echo "<label>Дата: $date </label><br>";
        echo "<label>Сервиз: $name </label><br>";
        echo "<label>Цена: $price </label><br>";
        echo "</br>";
        //echo "Car license: " . $car_license;
    }
    echo "<button id='addConsumesInfoBut' onclick='consAddForm()'>Обнови списъка</button>";
    echo "</div>";
}
// else {
//     echo "Car license is not set in the session.";
//  }
?>