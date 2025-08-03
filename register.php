<?php
session_start();
    function writeStringToFile($a, $string) {
       $s= "\xEF\xBB\xBF".$string; // utf8 bom
       fwrite($a, $s);
     }
// Initialize variables
$errors = [];


$myfile = fopen("Login_info.txt", "a+");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $errors[] = "All fields are required.";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    elseif ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    else{
        $txt = $email . $password . "\n";
        $_SESSION['user'] = $name;
        $_SESSION['logged_in'] = true;
        while (($line = fgets($myfile)) !== false) {
                if ( $txt == $line){
                    
                    $line = fgets($myfile);
                    $_SESSION['name'] = $line;
                    $line = fgets($myfile);
                    $_SESSION['id'] = $line;
                    fclose($myfile);
                    header("Location: http://localhost:8000/home.php");
                }
        }
        $lines = count(file("Login_info.txt"));
        writeStringToFile($myfile, $txt . $name . "\n" . $lines . "\n");
        $_SESSION['name'] = $name;
        
        $_SESSION['id'] = $lines;
        
        fclose($myfile);
        header("Location: http://localhost:8000/home.php");
    }

    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "User: " . htmlspecialchars($row['name']);
    } else {
        echo "No users found or query failed.";
    }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - ShopSmart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>

<div class="container mt-5 col-md-6">
    <h2 class="text-center">Register</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (min. 6 characters)</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label for="confirm" class="form-label">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="login.php" class="btn btn-link">Already have an account? Login</a>
    </form>
</div>

</body>
</html>