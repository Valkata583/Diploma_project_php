<?php
//  if(isset($_POST["repairShopButton"])){
$user = $_SESSION["user_id"];

$sql = "SELECT * FROM repair_shop WHERE customers = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$name=$row["name_repair_shop"];
$phone=$row["phone_number"];
echo "<div id='repairShopsInfo' action='index.php' method='POST' style='display: none'>";
echo "<label>Име на сервиза: $name </label><br>";
echo "<label>Телефон: $phone </label><br>";
echo "<button id='addRepairShopBut' onclick='repairShopAddForm()'>Добави сервиз</button>";
echo "</div>";
//  }
?>

