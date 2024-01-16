<?php
include 'koneksi.php';

// Ambil data dari formulir login
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Query untuk memeriksa keberadaan email
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Periksa apakah query dieksekusi dengan benar
    if (!$result) {
        throw new Exception("Query error: " . $conn->error);
    }

    $row = $result->fetch_assoc();

    // Periksa apakah email ditemukan
    if ($row) {
        // Email ditemukan, atur sesi atau tindakan lain yang diperlukan
        session_start();
        $_SESSION['user_id'] = $row['id'];
        // Redirect ke halaman lain setelah login berhasil
        header('Location: form');
        exit();
    } else {
        // Tampilkan pesan kesalahan
        echo "Email tidak terdaftar";
    }
} catch (Exception $e) {
    // Tangani error
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi database
$conn->close();
