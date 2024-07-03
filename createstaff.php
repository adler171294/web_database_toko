<!DOCTYPE html>
<html>
<head>
    <title>Data Staff</title>
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

        $id_staff = input($_POST["id_staff"]);
        $nama_staff = input($_POST["nama_staff"]);

        // Query untuk menginput data ke dalam tabel staff
        $sql = "INSERT INTO staff (id_staff, nama_staff) VALUES ('$id_staff', '$nama_staff')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: satff.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Masukan Data Staff</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>ID Staff:</label>
            <input type="text" name="id_staff" class="form-control" placeholder="Masukan ID staff" required />
        </div>
        <div class="form-group">
            <label>Nama Staff:</label>
            <input type="text" name="nama_staff" class="form-control" placeholder="Masukan nama staff" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
