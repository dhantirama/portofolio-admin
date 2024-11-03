<?php
session_start();
include 'conn.php';
if (isset($_POST['login'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $queryLogin = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($queryLogin) > 0 ) {
        $rowLogin = mysqli_fetch_assoc($queryLogin);
        if ($password == $rowLogin['password']) {
            $_SESSION['nama']   = $rowLogin['nama'];
            $_SESSION['id']     = $rowLogin['id'];
            header("location:admin/index.php");
        } else {
            header("location:login.php?login=gagal");
        }
    } else {
        header("location:login.php?login=failed");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <div class="form-container" id="login-form">
      <h1>Login</h1>
      <form method="post">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login" >Login</button>
      </form>
      <p>Don't have an account? <a href="#" id="signup-link">Sign up</a></p>
    </div>

    <div class="form-container" id="signup-form" style="display: none;">
      <h1>Sign Up</h1>
      <form>
        <label for="new-username">Username</label>
        <input type="text" id="new-username" name="new-username" required>
        <label for="new-email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="new-password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login">Sign Up</button>
      </form>
      <p>Already have an account? <a href="#" id="login-link">Login</a></p>
    </div>
  </div>
</body>
</html>
