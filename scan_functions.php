<?php
// insert_qr_data.php

header('Content-Type: application/json');

// Get raw POST data
$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['qrData']) && isset($inputData['st'])) {
    $qrData = $inputData['qrData'];
    $st = $inputData['st'];

    include 'conn.php';  // Include the database connection (make sure conn.php exists and is properly set up)

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO render_time (qr_data, st) VALUES (?, ?)");
    $stmt->bind_param('ss', $qrData, $st);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error inserting data']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}
?>
