<?php
$host     = "localhost";
$user     = "root";      // Default username XAMPP
$password = "";          // Default password XAMPP (kosong)
$database = "db_user";   // Sesuaikan dengan nama database Anda di phpMyAdmin

$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>