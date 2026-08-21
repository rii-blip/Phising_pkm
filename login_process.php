<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Koneksi ke Database XAMPP (MySQL)
$host     = "localhost";
$db_user  = "Ridwanmp";     // Default XAMPP
$db_pass  = "1904";         // Default XAMPP kosong
$db_name  = "db_user";  // Pastikan nama database ini sudah dibuat di phpMyAdmin

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// 2. Ambil data HANYA jika dikirim melalui method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Pastikan input name di HTML sesuai ('username' dan 'password')
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Pastikan input tidak kosong
    if (!empty($user) && !empty($pass)) {
        
        // 3. Query untuk MENAMBAHKAN data ke tabel 'users' tanpa hash
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $pass);

        if ($stmt->execute()) {
            header("Location: sukses.html"); // Redirect ke halaman sukses
            exit();
        } else {
            echo "Gagal menyimpan data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Username dan Password wajib diisi!";
    }
} else {
    // Jika diakses langsung via browser (GET Request)
    echo "Metode pengiriman tidak diizinkan. Silakan isi form login terlebih dahulu.";
}

$conn->close();
?>