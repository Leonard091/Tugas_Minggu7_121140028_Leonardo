<?php
$conn = new mysqli('localhost', 'root', '', 'institut_antariksa');

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>