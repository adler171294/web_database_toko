<!DOCTYPE html>
<html>
<head>
    <title>Data Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file conneksi, untuk conneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_pembeli=input($_POST["id_pembeli"]);
        $nama_pembeli=input($_POST["nama_pembeli"]);

        //Query input menginput data kedalam tabel anggota
        $sql="INSERT INTO pembeli (id_pembeli,nama_pembeli) values
		('$id_pembeli','$nama_pembeli')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($conn,$sql);

        //conndisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location: pembeli.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Masukan Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>id pembeli:</label>
            <input type="text" name="id_pembeli" class="form-control" placeholder="Masukan id customer" required />

        </div>
        <div class="form-group">
            <label>nama customer:</label>
            <input type="text" name="nama_pembeli" class="form-control" placeholder="Masukan nama customer" required/>
        </div>
            

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>