<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        include 'koneksi.php';

        if (isset($_GET['kode_prodi']) && $_GET['kode_prodi'] != '*') {
            $kode_prodi = $_GET['kode_prodi'];
        
            // Query untuk mencari mahasiswa berdasarkan kode_prodi
            $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE kode_prodi LIKE ?");
            $like_kode_prodi = "%{$kode_prodi}%";
            $stmt->bind_param("s", $like_kode_prodi);
        } else {
            // Query untuk menampilkan semua mahasiswa
            $stmt = $conn->prepare("SELECT * FROM mahasiswa");
        }
        
        // Menjalankan query
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<table><tr><th>NIM</th><th>Nama</th><th>Kode Prodi</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["nim"]."</td><td>".$row["nama"]."</td><td>".$row["kode_prodi"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada hasil";
        }
        
        $stmt->close();
        
    ?>

</body>
</html>



