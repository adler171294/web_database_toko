<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
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

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_transaksi
    if (isset($_GET['id_transaksi'])) {
        $id_transaksi = input($_GET["id_transaksi"]);
        $sql = "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_transaksi = input($_POST["id_transaksi"]);
        $tgl_transaksi = input($_POST["tgl_transaksi"]);
        $id_pembeli = input($_POST["id_pembeli"]);
        $id_staff = input($_POST["id_staff"]);

        // Query update data pada tabel transaksi
        $sql = "UPDATE transaksi SET
                tgl_transaksi='$tgl_transaksi',
                id_pembeli='$id_pembeli',
                id_staff='$id_staff'
                WHERE id_transaksi='$id_transaksi'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:transaksi.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>id transaksi:</label>
            <input type="text" name="id_transaksi" class="form-control" value="<?php echo isset($data['id_transaksi']) ? $data['id_transaksi'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>tanggal:</label>
            <input type="date" name="tgl_transaksi" class="form-control" value="<?php echo isset($data['tgl_transaksi']) ? $data['tgl_transaksi'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>id customer:</label>
            <input type="text" name="id_pembeli" class="form-control" value="<?php echo isset($data['id_pembeli']) ? $data['id_pembeli'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>id staff:</label>
            <input type="text" name="id_staff" class="form-control" value="<?php echo isset($data['id_staff']) ? $data['id_staff'] : ''; ?>" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
