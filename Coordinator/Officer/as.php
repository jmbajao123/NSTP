<?php
// Include the PHP QR Code library
include 'phpqrcode/qrlib.php'; 

// Check if assign_off_id is provided
if (isset($_POST['assign_off_id']) && !empty($_POST['assign_off_id'])) {
    $assign_off_id = htmlspecialchars($_POST['assign_off_id']);

    // QR Code storage path
    $qrFilePath = "qrcodes/";
    if (!file_exists($qrFilePath)) {
        mkdir($qrFilePath, 0777, true); // Create folder if it doesn't exist
    }

    // QR Code filename
    $qrFileName = $qrFilePath . "qrcode_" . $assign_off_id . ".png";

    // QR Code content (can be expanded to include more details)
    $qrContent = "Assign Officer ID: " . $assign_off_id;

    // Generate QR Code
    QRcode::png($qrContent, $qrFileName, QR_ECLEVEL_L, 5);

    // Display the generated QR Code
    echo "<h3>Generated QR Code for Assign Officer ID: $assign_off_id</h3>";
    echo "<img src='$qrFileName' alt='QR Code'>";
} else {
    echo "<h3>Error: Assign Officer ID is missing!</h3>";
}
?>