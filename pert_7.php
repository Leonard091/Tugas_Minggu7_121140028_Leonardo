<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Universitas Antariksa</h1>

<h2>Cari Data Mahasiwa</h2>

<div class="search-container">
    <input type="button" id="searchBar" value="Cari..." onclick="showDropdown()">
    <div id="searchDropdown" class="dropdown-content" style="display:none;">
        <a href="#" onclick="peformSearch('*')">Semua Mahasiswa</a>
        <a href="#" onclick="peformSearch('IF')">IF</a>
        <a href="#" onclick="peformSearch('EL')">EL</a>
        <a href="#" onclick="peformSearch('TG')">TG</a>
        <a href="#" onclick="peformSearch('PWK')">PWK</a>
        <a href="#" onclick="peformSearch('TI')">TI</a>
        <a href="#" onclick="peformSearch('GM')">GM</a>
        <a href="#" onclick="peformSearch('SA')">SA</a>
        <a href="#" onclick="peformSearch('SD')">SD</a>
        <a href="#" onclick="peformSearch('AS')">AS</a>
    </div>
</div>

<button class="button" onclick="location.href='tambahdata.php'">Tambah Data</button>

<table>
  <tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>Kode Prodi</th>
    <th>Aksi</th>
  </tr>
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
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["nim"]."</td>
                    <td>".$row["nama"]."</td>
                    <td>".$row["kode_prodi"]."</td>
                    <td><a href='ubah.php?nim=".$row["nim"]."'>Update</a> | <a href='hapusdata.php?nim=".$row["nim"]."'>Delete</a></td>
                    </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada hasil";
    }
    
    $stmt->close();
?>

</table>


<script>
    function showDropdown() {
        document.getElementById("searchDropdown").style.display = "block";
    }

    function peformSearch(value) {
    console.log("Pencarian untuk: " + value); // Ini akan muncul di console
    window.location.href = '?kode_prodi=' + encodeURIComponent(value);
    }

    window.onclick = function(event) {
        if (!event.target.matches('#searchBar')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display == "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>
