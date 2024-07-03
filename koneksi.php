<?php
$servername = "localhost";
$username = "root";
$password = ""; // Sesuaikan dengan password MySQL Anda, biasanya kosong jika default
$dbname = "toko_idola"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
