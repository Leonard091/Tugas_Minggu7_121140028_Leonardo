<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-section">
        <h2> Tambah Data Mahasiswa</h2>
        <form class="form" method="POST" action="tambahdata.php">
            NIM: <input type="text" name="nim"><br>
            Nama: <input type="text" name="nama"><br>
            Kode Prodi: 
            <select name="kode_prodi">
                <option value="IF">Informatika</option>
                <option value="EL">Elektro</option>
                <option value="PWK">Perencanaan Wilayah dan Kota</option>
                <option value="TG">Teknik Geologi</option>
                <option value="TI">Teknik Industri</option>
                <option value="GM">Geomatika</option>
                <option value="SA">Sains Aktuaria</option>
                <option value="SD">Sains Data</option>
                <option value="AS">Astronomi</option>
            </select><br>
            <input type="submit" value="Tambah Data">
        </form>
    </div>


    <?php
        include 'koneksi.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $kode_prodi = $_POST['kode_prodi'];
            
            $sql = "INSERT INTO mahasiswa (nim, nama, kode_prodi) VALUES ('$nim', '$nama', '$kode_prodi')";
            
            if (mysqli_query($conn, $sql)) {
                header("Location: pert_7.php");
                exit;
            } else {
                echo "Error: " . $sql . "\n" . $conn->error;
            }
            
            $conn->close();

        }
    
    ?>
</body>
</html>




