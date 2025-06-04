<?php
include 'conf.php';

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
$required = ['patient_name', 'patient_age', 'email', 'phoneNo', 'doctor_id', 'appointment_date', 'time_slot'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "$field is required"]);
        exit;
    }
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // 1. Create patient
    $patient_name = mysqli_real_escape_string($conn, $data['patient_name']);
    $patient_age = (int)$data['patient_age'];
    $email = mysqli_real_escape_string($conn, $data['email']);
    $phoneNo = mysqli_real_escape_string($conn, $data['phoneNo']);
    
    $query = "INSERT INTO patients (patient_name, patient_age, email, phoneNo) 
              VALUES ('$patient_name', $patient_age, '$email', '$phoneNo')";
    
    if (!mysqli_query($conn, $query)) {
        throw new Exception("Patient creation failed: " . mysqli_error($conn));
    }
    
    $patient_id = mysqli_insert_id($conn);
    
    // 2. Create appointment
    $doctor_id = (int)$data['doctor_id'];
    $appointment_date = mysqli_real_escape_string($conn, $data['appointment_date']);
    $time_slot = mysqli_real_escape_string($conn, $data['time_slot']);
    
    $query = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, time_slot) 
              VALUES ($patient_id, $doctor_id, '$appointment_date', '$time_slot')";
    
    if (!mysqli_query($conn, $query)) {
        throw new Exception("Appointment creation failed: " . mysqli_error($conn));
    }
    
    $appointment_id = mysqli_insert_id($conn);
    
    // Commit transaction
    mysqli_commit($conn);
    
    echo json_encode([
        'success' => true,
        'appointment_id' => $appointment_id,
        'patient_id' => $patient_id
    ]);
    
} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($conn);
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

mysqli_close($conn);
?>