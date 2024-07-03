<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
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

        $id_detail_transaksi = input($_POST["id_detail_transaksi"]);
        $id_transaksi = input($_POST["id_transaksi"]);
        $id_barang = input($_POST["id_barang"]);
        $jumlah = input($_POST["jumlah"]);
        $harga_barang = input($_POST["harga_barang"]);

        // Query untuk menginput data ke dalam tabel detail_transaksi
        $sql = "INSERT INTO detail_transaksi (id_detail_transaksi, id_transaksi, id_barang, jumlah, harga_barang) VALUES ('$id_detail_transaksi', '$id_transaksi', '$id_barang', '$jumlah', '$harga_barang')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Masukan Data Detail Transaksi</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>ID Detail Transaksi:</label>
            <input type="text" name="id_detail_transaksi" class="form-control" placeholder="Masukan ID Detail Transaksi" required />
        </div>
        <div class="form-group">
            <label>ID Transaksi:</label>
            <input type="text" name="id_transaksi" class="form-control" placeholder="Masukan ID Transaksi" required />
        </div>
        <div class="form-group">
            <label>ID Barang:</label>
            <input type="text" name="id_barang" class="form-control" placeholder="Masukan ID Barang" required />
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" class="form-control" placeholder="Masukan Jumlah Barang" required />
        </div>
        <div class="form-group">
            <label>Harga Barang:</label>
            <input type="number" name="harga_barang" class="form-control" placeholder="Masukan Harga Barang" required />
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
