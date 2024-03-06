<?php
$user = $_SESSION["user_id"];

$sql = 'SELECT license, brand, model FROM Static_Data WHERE car_owner = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user);
$stmt->execute();
$result = $stmt->get_result();

// Output container div
echo "<div id='car_choose'>";

// Fetching rows should be done inside the while loop
while ($row = $result->fetch_assoc()) {
    // Retrieve data for each row
    $license = $row["license"];
    $brand = $row["brand"];
    $model = $row["model"];

    // Output each car as a button
    echo "<button class='car-button' data-license='$license'>$brand $model</button>";
}

// Close container div
echo "</div>";
