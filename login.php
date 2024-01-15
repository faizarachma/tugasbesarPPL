<?php
include 'koneksi.php';

// Ambil data dari formulir login
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Query untuk memeriksa data pengguna
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Periksa apakah query dieksekusi dengan benar
    if (!$result) {
        throw new Exception("Query error: " . $conn->error);
    }

    // Periksa apakah pengguna ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Periksa apakah kata sandi cocok
        if (password_verify($password, $hashedPassword)) {
            // Otentikasi berhasil, atur sesi atau tindakan lain yang diperlukan
            session_start();
            $_SESSION['user_id'] = $row['id'];
            // Redirect ke halaman lain setelah login berhasil
            header('Location: form.html');
            exit();
        } else {
            // Password tidak cocok, beri tahu pengguna
            echo "Password tidak benar";
        }
    } else {
        // Pengguna tidak ditemukan, beri tahu pengguna
        echo "Email tidak terdaftar";
    }
} catch (Exception $e) {
    // Tangani error
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi database
$conn->close();
?>
