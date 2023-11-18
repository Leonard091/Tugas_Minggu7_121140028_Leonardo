<?php
include 'koneksi.php';

$nim = $_GET['nim'];

$sql = "DELETE FROM mahasiswa WHERE nim=$nim";

if (mysqli_query($conn, $sql)) {
    header("Location: pert_7.php");
    exit;
} else {
    echo "Error: " . $sql . "\n" . $conn->error;
}

$conn->close();
?>