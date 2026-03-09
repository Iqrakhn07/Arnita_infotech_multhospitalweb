<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $email = mysqli_real_escape_string($conn, $_POST['patient_email']);
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $time = mysqli_real_escape_string($conn, $_POST['appointment_time']);

    $sql = "INSERT INTO appointments (patient_name, patient_email, doctor_name, appointment_date, appointment_time) 
            VALUES ('$name', '$email', '$doctor', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment Booked Successfully! Waiting for Doctor Confirmation.'); window.location.href='book.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='book.php';</script>";
    }
}
?>