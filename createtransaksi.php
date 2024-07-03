<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
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

        $id_transaksi = input($_POST["id_transaksi"]);
        $tgl_transaksi = input($_POST["tgl_transaksi"]);
        $id_pembeli = input($_POST["id_pembeli"]);
        $id_staff = input($_POST["id_staff"]);

        // Query untuk menginput data ke dalam tabel transaksi
        $sql = "INSERT INTO transaksi (id_transaksi, tgl_transaksi, id_pembeli, id_staff) VALUES ('$id_transaksi', '$tgl_transaksi', '$id_pembeli', '$id_staff')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: transaksi.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Masukan Data Transaksi</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>id Transaksi:</label>
            <input type="text" name="id_transaksi" class="form-control" placeholder="Masukan ID transaksi" required />
        </div>
        <div class="form-group">
            <label>Tanggal Transaksi:</label>
            <input type="date" name="tgl_transaksi" class="form-control" placeholder="Masukan tanggal transaksi" required />
        </div>
        <div class="form-group">
            <label>ID Pembeli:</label>
            <input type="text" name="id_pembeli" class="form-control" placeholder="Masukan ID pembeli" required />
        </div>
        <div class="form-group">
            <label>ID Staff:</label>
            <input type="text" name="id_staff" class="form-control" placeholder="Masukan ID staff" required />
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
