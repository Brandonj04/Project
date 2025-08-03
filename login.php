<?php
session_start();

// Initialize error
$error = '';
$myfile = fopen("Login_info.txt", "a+");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $txt = $email . $password;

    if (!empty($email) && !empty($password)) {
        while (($line = fgets($myfile)) !== false) {
            if ( $txt= $line){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $line = fgets($myfile);
                $_SESSION['name'] = $line;
                $line = fgets($myfile);
                $_SESSION['id'] = $line;
                $_SESSION['logged_in'] = true;
                header("Location: http://localhost:8000/home.php");
            }
        }

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                // Login success
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                ];
                header("Location: profile.php"); // or dashboard.php
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Account not found.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ShopSmart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 col-md-6">
    <h2 class="text-center mb-4">Login</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="register.php" class="btn btn-link">Create an account</a>
    </form>
</div>

</body>
</html>