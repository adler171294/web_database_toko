<!DOCTYPE html>
<html>
<head>
    <title>Data Staff</title>
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

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_pembeli
    if (isset($_GET['id_pembeli'])) {
        $id_pembeli = input($_GET["id_pembeli"]);
        $sql = "SELECT * FROM pembeli WHERE id_pembeli='$id_pembeli'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_pembeli = input($_POST["id_pembeli"]);
        $nama_pembeli = input($_POST["nama_pembeli"]);

        // Query update data pada tabel staff
        $sql = "UPDATE pembeli SET
                nama_pembeli='$nama_pembeli'
                WHERE id_pembeli='$id_pembeli'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:pembeli.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>id pembeli:</label>
            <input type="text" name="id_pembeli" class="form-control" value="<?php echo isset($data['id_pembeli']) ? $data['id_pembeli'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>nama pembeli:</label>
            <input type="text" name="nama_pembeli" class="form-control" value="<?php echo isset($data['nama_pembeli']) ? $data['nama_pembeli'] : ''; ?>" required/>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
