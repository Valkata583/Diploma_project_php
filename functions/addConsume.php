<?php
if(isset($_SESSION['carLicense'])){
    if(isset($_POST['consumesAddBut'])){
        $consService = filter_input(INPUT_POST, 'consService', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT `id` FROM repair_shop WHERE name_repair_shop = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $consService);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $serviceId = $row["id"];
    


        $consType = filter_input(INPUT_POST, 'consType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $consDescription = filter_input(INPUT_POST, 'consDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $consKm = filter_input(INPUT_POST, 'consKm', FILTER_VALIDATE_INT);
        $consDate = filter_input(INPUT_POST, 'consDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $consPrice = filter_input(INPUT_POST, 'consPrice', FILTER_VALIDATE_INT);
        $consCar = $_SESSION['carLicense'];

        try {
            $stmt = $conn->prepare("INSERT INTO consumes (consume_type, date_cons, kilometers, description_cons, car, repair_shop, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissid", $consType, $consDate, $consKm, $consDescription, $consCar, $serviceId, $consPrice);
            if ($stmt->execute()) {
                echo "Changed consume added successfully";
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
    <form id='addConsumes' method='POST' style='display:none'>
    <button type='button' class='close' onclick='closeForm3()'>x</button>
    <label class='addLabel' for='consType'>Вид на сменен консуматив:</label>
    <input class='addInput' id='consType' type='text' name='consType'>
    <br>
    <label class='addLabel' for='consDescription'>Описание:</label>
    <textarea class='addInput' id='consDescription' type='textarea' name='consDescription' style='rows='4';'></textarea>    <br>
    <label class='addLabel' for='repairKm'>Километри:</label>
    <input class='addInput' id='consKm' type='text' name='consKm'>
    <br>
    <label class='addLabel' for='consDate'>Дата [гггг-мм-дд]:</label>
    <input class='addInput' id='consDate' type='text' name='consDate'>
    <br>
    <label class='addLabel' for='consService'>Сервиз:</label>
    <input class='addInput' id='consService' type='text' name='consService'>
    <br>
    <label class='addLabel' for='consPrice'>Цена:</label>
    <input class='addInput' id='consPrice' type='text' name='consPrice'>
    <br>
    <input type='submit' id='consumesAddBut' name='consumesAddBut' value='Добави'>
    </form>
    " 
?>