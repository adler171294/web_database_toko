<!DOCTYPE html>
<html>
<head>
    <title>Data barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php

    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_barang
    if (isset($_GET['id_barang'])) {
        $id_barang = input($_GET["id_barang"]);
        // $id_barang = 1200;
        $sql = "SELECT * FROM barang WHERE id_barang='$id_barang'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_barang = input($_POST["id_barang"]);
        $nama_barang = input($_POST["nama_barang"]);
        $harga_barang = input($_POST["harga_barang"]);
        $stok_barang = input($_POST["stok_barang"]);
        $id_supplier = input($_POST["id_supplier"]);

        // Query update data pada tabel barang
        $sql = "UPDATE barang SET
                nama_barang='$nama_barang',
                harga_barang='$harga_barang',
                stok_barang='$stok_barang',
                id_supplier='$id_supplier'
                WHERE id_barang='$id_barang'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:barang.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>id barang:</label>
            <input type="text" name="id_barang" class="form-control" value="<?php echo isset($data['id_barang']) ? $data['id_barang'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>nama barang:</label>
            <input type="text" name="nama_barang" class="form-control" value="<?php echo isset($data['nama_barang']) ? $data['nama_barang'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>harga barang:</label>
            <input type="number" name="harga_barang" class="form-control" value="<?php echo isset($data['harga_barang']) ? $data['harga_barang'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok_barang" class="form-control" value="<?php echo isset($data['stok_barang']) ? $data['stok_barang'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>id supplier:</label>
            <input type="text" name="id_supplier" class="form-control" value="<?php echo isset($data['id_supplier']) ? $data['id_supplier'] : ''; ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
