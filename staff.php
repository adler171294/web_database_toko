<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TOKO IDOLA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pembeli.php">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="barang.php">Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="staff.php">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="supplier.php">Supplier</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    <br>
    <h4><center>STAFF</center></h4>
<?php

    include "koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id_staff'])) {
        $id_staff=htmlspecialchars($_GET["id_staff"]);

        $sql = "DELETE FROM staff WHERE id_staff='$id_staff'";
        $hasil = mysqli_query($conn, $sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:staff.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


     <tr class="table-danger">
            <br>
        <thead>
        <tr>
       <table class="my-3 table table-bordered">
            <tr class="table-primary">           
            <th>No</th>
            <th>id staff</th>
            <th>nama staff</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="select * from staff order by id_staff desc";

        $hasil=mysqli_query($conn,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["id_staff"]; ?></td>
                <td><?php echo $data["nama_staff"];   ?></td>
                <td>
                    <a href="updatestaff.php?id_staff=<?php echo htmlspecialchars($data['id_staff']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_staff=<?php echo $data['id_staff']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="createstaff.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
</body>
</html>
