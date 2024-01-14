<?php
include 'koneksi.php';

// Ambil data dari formulir login
$email = $_POST['email'];
$password = $_POST['password'];

// Query untuk memeriksa data pengguna
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($query);

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

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="assets/css/main.css" rel="stylesheet" />
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link href="assets/img/Logo Alutsista.png" rel="icon" />
    <link href="assets/img/Logo Alutsista.png" rel="apple-touch-icon" />
  </head>
  <body>
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img
              src="assets/img/img-hero.png"
              class="img-fluid"
              alt="Phone image"
            />
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <form action="login.php" method="POST">
              <h1 class="text-center font-weight-bold">LOGIN</h1>
              <p class="mb-4 text-center">Login dengan identitas anda</p>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example13"
                  >Email address</label
                >
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-control form-control-lg"
                />
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example23">Password</label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="form-control form-control-lg"
                />
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Login
              </button>
              <a href="index.html" class="btn btn-secondary btn-lg btn-block"
                >Kembali</a
              >
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

