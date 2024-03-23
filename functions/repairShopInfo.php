<?php
// if(session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
// include_once(__DIR__ . '/../data/database.php');


$user = $_SESSION["user_id"];

$sql = "SELECT * FROM repair_shop WHERE customers = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();
echo "<div id='repairShopsInfo' style='display: none;'>";
while ($row = $result->fetch_assoc()) {

    $name = $row["name_repair_shop"];
    $phone = $row["phone_number"];
    echo "<label>Име на сервиза: $name </label><br>";
    echo "<label>Телефон: $phone </label><br>";
    echo "</br>";
    echo "<hr>";
}
echo "<button id='addRepairShopBut' onclick='repairShopAddForm()'>Добави сервиз</button>";
echo "</div>";

?>
