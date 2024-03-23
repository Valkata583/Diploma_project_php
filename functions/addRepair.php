<?php
if(isset($_SESSION['carLicense'])){
    if(isset($_POST['repairsAddBut'])){
        $repairService = filter_input(INPUT_POST, 'repairService', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT `id` FROM repair_shop WHERE name_repair_shop = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $repairService);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $serviceId = $row["id"];
    


        $repairType = filter_input(INPUT_POST, 'repairType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repairDescription = filter_input(INPUT_POST, 'repairDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repairKm = filter_input(INPUT_POST, 'repairKm', FILTER_VALIDATE_INT);
        $repairDate = filter_input(INPUT_POST, 'repairDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repairPrice = filter_input(INPUT_POST, 'repairPrice', FILTER_VALIDATE_INT);
        $repairCar = $_SESSION['carLicense'];

        try {
            $stmt = $conn->prepare("INSERT INTO unplaned_repairs (unplanned_type, date_repair, kilometers, description_repair, car, repair_shop, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissid", $repairType, $repairDate, $repairKm, $repairDescription, $repairCar, $serviceId, $repairPrice);
            if ($stmt->execute()) {
                echo "Unplanned repair added successfully";
                echo"<script>window.location.href='index.php';</script>";
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }

     }
 }
 ?>

<?php
    echo "
    <form id='addRepairs' method='POST' style='display:none'>
    <button type='button' class='close' onclick='closeForm2()'>x</button>
    <label class='addLabel' for='repairType'>Вид на ремонта:</label>
    <input class='addInput' id='repairType' type='text' name='repairType'>
    <br>
    <label class='addLabel' for='repairDescription'>Описание:</label>
    <textarea class='addInput' id='repairDescription' type='textarea' name='repairDescription' style='rows='4';'></textarea>    <br>
    <label class='addLabel' for='repairKm'>Километри:</label>
    <input class='addInput' id='repairKm' type='text' name='repairKm'>
    <br>
    <label class='addLabel' for='repairDate'>Дата [гггг-мм-дд]:</label>
    <input class='addInput' id='repairDate' type='text' name='repairDate'>
    <br>
    <label class='addLabel' for='repairService'>Сервиз:</label>
    <input class='addInput' id='repairService' type='text' name='repairService'>
    <br>
    <label class='addLabel' for='repairPrice'>Цена:</label>
    <input class='addInput' id='repairPrice' type='text' name='repairPrice'>
    <br>
    <input type='submit' id='repairsAddBut' name='repairsAddBut' value='Добави'>
    </form>
    " 
?>