<?php
require_once '../config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :u");
    $stmt->execute([':u' => $user]);
    $admin = $stmt->fetch();
        
    if ($admin && $admin['password'] === $pass) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: dashboard.php');
        exit;
    }else{
        $error='Invalid login information!!';
    }
}
  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/project.css">
</head>
<body class="login-container">
    <div class="login-box">
        <h1>Admin Login</h1>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <a href="../index.php">Go to Website</a>
    </div>
</body>
</html>