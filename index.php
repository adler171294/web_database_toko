<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail transaksi</title>
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
    <h4><center>DETAIL TRANSAKSI</center></h4>
<?php

    include "koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id_detail_transaksi'])) {
        $id_detail_transaksi=htmlspecialchars($_GET["id_detail_transaksi"]);

        $sql = "DELETE FROM detail_transaksi WHERE id_detail_transaksi='1200'";
        $hasil = mysqli_query($conn, $sql);
        

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

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
            <th>id detail transaksi</th>
            <th>id transaksi</th>
            <th>id barang</th>
            <th>jumlah</th>
            <th>harga barang</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="select * from detail_transaksi order by id_detail_transaksi desc";

        $hasil=mysqli_query($conn,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["id_detail_transaksi"]; ?></td>
                <td><?php echo $data["id_transaksi"];   ?></td>
                <td><?php echo $data["id_barang"];   ?></td>
                <td><?php echo $data["jumlah"];   ?></td>
                <td><?php echo $data["harga_barang"];   ?></td>
                <td>
                    <a href="update.php?id_detail_transaksi=<?php echo htmlspecialchars($data['id_detail_transaksi']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_detail_transaksi=<?php echo $data['id_detail_transaksi']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="createdetail.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
</body>
</html>
