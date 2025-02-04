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

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan id_staff
    if (isset($_GET['id_staff'])) {
        $id_staff = input($_GET["id_staff"]);
        $sql = "SELECT * FROM staff WHERE id_staff='$id_staff'";
        $hasil = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_staff = input($_POST["id_staff"]);
        $nama_staff = input($_POST["nama_staff"]);

        // Query update data pada tabel staff
        $sql = "UPDATE staff SET
                nama_staff='$nama_staff'
                WHERE id_staff='$id_staff'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($conn, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:staff.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }

    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>id staff:</label>
            <input type="text" name="id_staff" class="form-control" value="<?php echo isset($data['id_staff']) ? $data['id_staff'] : ''; ?>" readonly />
        </div>
        <div class="form-group">
            <label>nama staff:</label>
            <input type="text" name="nama_staff" class="form-control" value="<?php echo isset($data['nama_staff']) ? $data['nama_staff'] : ''; ?>" required/>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
