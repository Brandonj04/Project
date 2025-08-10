<?php
session_start();

$error = '';
$myfile = fopen("Login_info.txt", "a+");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $txt = $email . $password;

    if (!empty($email) && !empty($password)) {
        while (!feof($myfile)) {
            $line = fgets($myfile);
            if ($txt= $line){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['name'] = fgets($myfile);
                $_SESSION['id'] = fgets($myfile);
                $_SESSION['logged_in'] = true;
                fclose($myfile);
                header("Location: http://localhost:8000/home.php");
            }
        
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
    <title>Login</title>
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