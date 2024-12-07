<?php
header('Content-Type: application/json');

// Generate an array of 20 random numbers
$randomNumbers = array();
for ($i = 0; $i < 7; $i++) {
    $randomNumbers[] = rand(1, 100); // You can adjust the range of the random numbers if needed
}

// Return the array as a JSON response
echo json_encode($randomNumbers);
?>
