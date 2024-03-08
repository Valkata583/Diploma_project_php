<?php
//  if(isset($_POST["repairShopButton"])){
// $user = $_SESSION["user_id"];

// $sql = 'SELECT * FROM repair_shop WHERE customers = ?';
// $stmt = $conn->prepare($sql);
// $stmt->bind_param('i', $user);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();
// $name=$row["name"];
// $phone=$row["phone"];
// echo "$name";
// echo "$phone";
// echo "<button id='addRepairShopBut'>Добави сервиз</button>";
//  }

// if (isset($_POST["repairShopButton"])) {
//     $user = $_SESSION["user_id"];
    
//     // Assuming $conn is your database connection
    
//     // Prepare the SQL query
//     $sql = 'SELECT * FROM repair_shop WHERE customers = ?';
//     $stmt = $conn->prepare($sql);
    
//     // Bind the user ID parameter
//     $stmt->bind_param('i', $user);
    
//     // Execute the query
//     $stmt->execute();
    
//     // Get the result set
//     $result = $stmt->get_result();
    
//     // Check if there are rows returned
//     if ($result->num_rows > 0) {
//         // Loop through each row
//         while ($row = $result->fetch_assoc()) {
//             $name = $row["name"];
//             $phone = $row["phone_number"]; // Corrected column name
//             echo "Name: $name<br>";
//             echo "Phone: $phone<br>";
//         }
//     } else {
//         echo "No repair shop found for the current user.";
//     }
    
//     // Free the result set
//     $result->free();
    
//     echo "<button id='addRepairShopBut'>Добави сервиз</button>";
// }
$user = $_SESSION["user_id"];
$sql = "SELECT * FROM repair_shop WHERE customers = $user";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      $name = $row["name"];
      $phone = $row["phone_number"]; 
      echo "<div id='repairShopInfo'>";
      echo "Име на сервиза: $name";
      echo "Телефон: $phone";
      echo "</div>";  
        // You can fetch other columns similarly
    }
} else {
    echo "0 results";
}

?>

