<?php
require_once('koneksi.php');

// Path to save signature images
$uploadDirectory = 'foto_signature/';

// Validate if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signatureImage']) && isset($_POST['no_hp'])) {
    
    // Check if directory exists or create it
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }
    
    // Decode base64 encoded image
    $encodedImage = $_POST['signatureImage'];
    $decodedImage = base64_decode($encodedImage);
    
    // Generate unique file name for image
    $fileName = uniqid() . '.png'; // Change extension as needed
    
    // Path to save image
    $uploadPath = $uploadDirectory . $fileName;
    
    // Save image to server
    if (file_put_contents($uploadPath, $decodedImage)) {
        // Image saved successfully
        
        // Save image filename to database tb_tilang
        $conn = $con;
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare statement
        $stmt = $conn->prepare("UPDATE tb_tilang SET signature = ?, updated_at = NOW() WHERE no_hp = ?");
        
        // Bind parameters
        $stmt->bind_param("ss", $fileName, $_POST['no_hp']); // Save only filename
        
        // Execute statement
        if ($stmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Tanda tangan berhasil disimpan.',
                'signature_path' => $uploadPath // Optional: Return full path if needed
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal menyimpan tanda tangan ke database.'
            );
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
        
    } else {
        // Failed to save image
        $response = array(
            'status' => 'error',
            'message' => 'Gagal menyimpan tanda tangan di server.'
        );
    }
} else {
    // Invalid request
    $response = array(
        'status' => 'error',
        'message' => 'Request tidak valid.'
    );
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
