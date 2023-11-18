<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        include 'koneksi.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $kode_prodi = $_POST['kode_prodi'];

            $sql = "UPDATE mahasiswa SET nama='$nama', kode_prodi='$kode_prodi' WHERE nim=$nim";

            if (mysqli_query($conn, $sql)) {
                header("Location: pert_7.php");
                exit;
            } else {
                echo "Error: " . $sql . "\n" . $conn->error;
            }

            $conn->close();
        } else {
            $nim = $_GET['nim'];
            $sql = "SELECT * FROM mahasiswa WHERE nim=$nim";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nim = $row['nim'];
                $nama = $row['nama'];
                $kode_prodi = $row['kode_prodi'];
            } else {
                echo "Data tidak ditemukan";
            }
        }
    ?>


    <div class="form-section">
        <form class="form" method="post" action="ubah.php">
            <input type="hidden" name="nim" value="<?php echo $nim; ?>">
            Nama: <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
            Kode Prodi: 
            <select name="kode_prodi">
                <option value="IF">Informatika</option>
                <option value="EL">Elektro</option>
                <option value="PWK">Perencanaan Wilayah dan Kota</option>
                <option value="TI">Teknik Industri</option>
                <option value="GM">Geomatika</option>
                <option value="SA">Sains Aktuaria</option>
                <option value="SD">Sains Data</option>
                <option value="AS">Astronomi</option>
            </select><br>
            <input type="submit" value="Ubah Data">
        </form>
    </div>

</body>
</html>



