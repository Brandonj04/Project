<?php
session_start();


$userId = $_SESSION['id'];
$success = '';
$error = '';
$myfile = fopen("Login_info.txt", "a+");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_SESSION['name'];
    $email    = $_SESSION['email'];
    $password = $_SESSION['password'];
    $confirm  = $_POST['confirm'];

    if (empty($name) || empty($email)) {
        $error = "Name and email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (!empty($password) && $password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        
    
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container mt-5 col-md-6">
    <h2 class="text-center mb-4">Your Profile</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="profile.php">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" <?= $_SESSION['name'] ?>>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" <?= $_SESSION['email'] ?>>
        </div>

        <hr>
        <p class="text-muted">Leave password fields blank if you don't want to change it.</p>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (optional)</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6">
        </div>

        <div class="mb-3">
            <label for="confirm" class="form-label">Confirm New Password</label>
            <input type="password" name="confirm" id="confirm" class="form-control" minlength="6">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="home.php" class="btn btn-secondary">Back to Home</a>
    </form>
</div>

</body>
</html>