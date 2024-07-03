<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
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

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_detail_transaksi
    if (isset($_GET['id_detail_transaksi'])) {
        $id_detail_transaksi = input($_GET["id_detail_transaksi"]);
        // $id_detail_transaksi = 1200;
        $sql = "SELECT * FROM detail_transaksi WHERE id_detail_transaksi='$id_detail_transaksi'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_detail_transaksi = input($_POST["id_detail_transaksi"]);
        $id_transaksi = input($_POST["id_transaksi"]);
        $id_barang = input($_POST["id_barang"]);
        $jumlah = input($_POST["jumlah"]);
        $harga_barang = input($_POST["harga_barang"]);

        // Query update data pada tabel detail_transaksi
        $sql = "UPDATE detail_transaksi SET
                id_transaksi='$id_transaksi',
                id_barang='$id_barang',
                jumlah='$jumlah',
                harga_barang='$harga_barang'
                WHERE id_detail_transaksi='$id_detail_transaksi'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>ID Detail Transaksi:</label>
            <input type="text" name="id_detail_transaksi" class="form-control" value="<?php echo isset($data['id_detail_transaksi']) ? $data['id_detail_transaksi'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>ID Transaksi:</label>
            <input type="text" name="id_transaksi" class="form-control" value="<?php echo isset($data['id_transaksi']) ? $data['id_transaksi'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>ID Barang:</label>
            <input type="text" name="id_barang" class="form-control" value="<?php echo isset($data['id_barang']) ? $data['id_barang'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" class="form-control" value="<?php echo isset($data['jumlah']) ? $data['jumlah'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>Harga Barang:</label>
            <input type="number" name="harga_barang" class="form-control" value="<?php echo isset($data['harga_barang']) ? $data['harga_barang'] : ''; ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
