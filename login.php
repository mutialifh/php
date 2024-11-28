<?php
session_start();

// Jika user sudah login, redirect langsung berdasarkan role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
        exit;
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: user.php");
        exit;
    }
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Simulasi autentikasi sederhana
    if ($role === 'admin' && $username === 'admin' && $password === 'admin123') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header("Location: admin.php");
        exit;
    } elseif ($role === 'user' && $username === 'user' && $password === 'user123') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header("Location: user.php");
        exit;
    } else {
        $error = "Invalid username, password, or role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Login as:</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>