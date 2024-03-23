<?php
session_start();
include("./data/database.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="index.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- header -->
    <?php include("./functions/header.php"); ?>
    
    <!-- Car Chooser -->
    <?php include ("./functions/carChoose.php"); ?>
    
    <section>
        <!-- Left menu -->
        <?php include ("./functions/leftMenu.php");?>
        
        <!-- Right side -->
        <div id="div_right">
            
            <!-- Add car -->
            <?php include ("./functions/addCar.php"); ?>
            
            <!-- Car data -->
            <?php include ("./functions/carInfo.php"); ?> 
            
            <!-- Service data -->
            <?php include ("./functions/repairShopInfo.php"); ?>
            
            <!-- Add service -->
            <?php include("./functions/addRepairShop.php"); ?> 

            <!-- Unplanned repairs data -->
            <?php include("./functions/repairInfo.php");?>

            <!-- Add unplanned repairs --> 
            <?php include("./functions/addRepair.php"); ?>

            <!-- Changed consumes data -->
            <?php include("./functions/consumeInfo.php"); ?>

            <!-- Add changed consumes -->
            <?php include("./functions/addConsume.php"); ?>

            <!-- <form id="consumesForm" action="index.php" method="POST">
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
            </form> -->

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
    <?php include ("./functions/footer.php");?>
    <script src="index.js"></script>
</body>

</html>