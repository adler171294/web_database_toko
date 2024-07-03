<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
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

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_supplier
    if (isset($_GET['id_supplier'])) {
        $id_supplier = input($_GET["id_supplier"]);
        $sql = "SELECT * FROM supplier WHERE id_supplier='$id_supplier'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_supplier = input($_POST["id_supplier"]);
        $nama_supplier = input($_POST["nama_supplier"]);
        $no_telp = input($_POST["no_telp"]);

        // Query update data pada tabel supplier
        $sql = "UPDATE supplier SET
                nama_supplier='$nama_supplier',
                no_telp='$no_telp'
                WHERE id_supplier='$id_supplier'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:supplier.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>id supplier:</label>
            <input type="text" name="id_supplier" class="form-control" value="<?php echo isset($data['id_supplier']) ? $data['id_supplier'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>nama supplier:</label>
            <input type="text" name="nama_supplier" class="form-control" value="<?php echo isset($data['nama_supplier']) ? $data['nama_supplier'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>no telp:</label>
            <input type="number" name="no_telp" class="form-control" value="<?php echo isset($data['no_telp']) ? $data['no_telp'] : ''; ?>" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
