 <?php
$user = $_SESSION["user_id"];
if (isset($_POST["repairShopAddBut"])) {
    $nameRepairShop = filter_input(INPUT_POST, 'repairShopName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phoneNumber = filter_input(INPUT_POST, 'repairShopPhone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try {
        $stmt = $conn->prepare("INSERT INTO repair_shop (name_repair_shop, phone_number, customers) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nameRepairShop, $phoneNumber, $user,);
        if ($stmt->execute()) {
            // Redirect after successful form submission
            echo "Service added successfully";
            //header("Location: index.php");
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
?>
    <?php
    echo "
    <form id='addRepairShops' method='POST' style='display:none'>
    <button type='button' class='close' onclick='closeForm1()'>x</button>
    <label class='addLabel' for='repairShopName'>Име на сервиз:</label>
    <input class='addInput' id='repairShopName' type='text' name='repairShopName'>
    <br>
    <label class='addLabel' for='repairShopPhone'>Телефон:</label>
    <input class='addInput' id='repairShopPhone' type='text' name='repairShopPhone'>
    <br>
    <input type='submit' id='repairShopAddBut' name='repairShopAddBut' value='Добави'>
    </form>
    " 
    ?>