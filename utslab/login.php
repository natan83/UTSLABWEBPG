<?php 
session_start(); 
include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); 
    $stmt->execute([$email]); 
    $user = $stmt->fetch(); 

    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user_id'] = $user['id']; 
        header("Location: dashboard.php"); 
    } else { 
        $error = "Invalid credentials"; 
    } 
} 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url('uploads/bg-login.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #d9534f;
            border-color: #d9534f;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .btn-primary:active, .btn-primary:focus {
            background-color: #c9302c !important; 
            border-color: #ac2925 !important; 
            box-shadow: none;
        }
        .form-label {
            color: #555;
            font-weight: 500;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
        }
        .card-header h2 {
            color: #d9534f;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .alert {
            border-radius: 10px;
        }
        .back-arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5em;
            color: white;
            text-decoration: none;
        }
        .back-arrow:hover {
            color: white; 
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-3">
                    <div class="card-header text-center">
                        <h2>To-Do-List Login</h2>
                        <img src="uploads/ten10.png" alt="Logo" class="img-fluid" style="width: 100px;">
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Don't have an account? <a href="register.php" style="color: #d9534f;">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
