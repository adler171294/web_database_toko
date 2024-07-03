<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_supplier = input($_POST["id_supplier"]);
        $nama_supplier = input($_POST["nama_supplier"]);
        $no_telp = input($_POST["no_telp"]);

        // Query untuk menginput data ke dalam tabel supplier
        $sql = "INSERT INTO supplier (id_supplier, nama_supplier, no_telp) VALUES ('$id_supplier', '$nama_supplier', '$no_telp')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: supplier.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Masukan Data Supplier</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>ID Supplier:</label>
            <input type="text" name="id_supplier" class="form-control" placeholder="Masukan ID supplier" required />
        </div>
        <div class="form-group">
            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" class="form-control" placeholder="Masukan nama supplier" required/>
        </div>
        <div class="form-group">
            <label>No Telp:</label>
            <input type="number" name="no_telp" class="form-control" placeholder="Masukan no telp" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
