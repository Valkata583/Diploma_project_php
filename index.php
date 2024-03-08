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

    <!-- Car Chooser -->
    <?php include ("./functions/carChoose.php"); ?>

    <section>
        <!-- left menu -->
        <?php include ("./functions/leftMenu.php");?>
        
        <!-- Right side -->
        <div id="div_right">
            
        <!-- add car -->
            <?php include ("./functions/addCar.php"); ?>

        <!-- Car data -->
            <?php include ("./functions/carInfo.php"); ?> 
            
        <!-- Service data -->
            <?php include ("./functions/repairShopInfo.php"); ?>    

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