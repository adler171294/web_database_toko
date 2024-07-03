<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk koneksi ke database
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

        $id_barang = input($_POST["id_barang"]);
        $nama_barang = input($_POST["nama_barang"]);
        $harga_barang = input($_POST["harga_barang"]);
        $stok_barang = input($_POST["stok_barang"]);
        $id_supplier = input($_POST["id_supplier"]);

        // Query untuk menginput data ke dalam tabel barang
        $sql = "INSERT INTO barang (id_barang, nama_barang, harga_barang, stok_barang, id_supplier) VALUES ('$id_barang', '$nama_barang', '$harga_barang', '$stok_barang', '$id_supplier')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:barang.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Masukan Data Barang</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>ID Barang:</label>
            <input type="text" name="id_barang" class="form-control" placeholder="Masukan ID barang" required />
        </div>
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan nama barang" required/>
        </div>
        <div class="form-group">
            <label>Harga Barang:</label>
            <input type="number" name="harga_barang" class="form-control" placeholder="Masukan harga barang" required/>
        </div>
        <div class="form-group">
            <label>Stok Barang:</label>
            <input type="number" name="stok_barang" class="form-control" placeholder="Masukan stok barang" required/>
        </div>
        <div class="form-group">
            <label>ID Supplier:</label>
            <input type="text" name="id_supplier" class="form-control" placeholder="Masukan ID supplier" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
