<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Ten 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden; 
        }

        body {
            overflow-y: scroll; 
            overscroll-behavior: none; 
        }

        html {
            overscroll-behavior: contain; 
        }

        ::-webkit-scrollbar {
            display: none; 
        }

        .welcome-section {
            background-image: url('uploads/bg-index.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content {
            width: 100%;
            padding: 20px;
            max-width: 1200px;
            text-align: center;
            box-sizing: border-box;
        }

        .navbar {
            height: 70px;
            background-color: #420D09;
            padding: 0 15px;
            z-index: 2; 
            position: fixed; 
            width: 100%;
            top: 0; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 30px;
            color: white;
            text-shadow: 2px 2px 5px #000;
        }

        .navbar-logo {
            max-height: 60px;
            width: auto; 
            object-fit: contain;
        }

        .navbar-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700; 
            font-size: 24px;
            color: white;
        }

        .nav-link {
            color: white !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #C7C6C1 !important;
        }

        h1 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .btn-custom {
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 30px;
        }

        .btn-custom:hover {
            background-color: #777B7E;
            color: white;
            transition: all 0.6s ease;
        }

        .btn-success {
            background-color: #0000CD;
            border: none;
        }

        .btn-primary {
            background-color: #DF2800;
            border: none;
        }

        .btn-success:focus, .btn-primary:focus {
            background-color: #777B7E !important;
            color: white !important;
            box-shadow: none;
        }

        .footer-links a {
            color: #212529;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #7C0A02;
        }

        @media (max-width: 768px) {
            .navbar-text {
                font-size: 1.2rem;
            }
        }

        html {
            overscroll-behavior-y: contain; 
        }

        @media (max-width: 768px) {
            .navbar-text {
                font-size: 1.2rem;
            }

            .navbar-toggler {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark"> 
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="uploads/ten10.png" alt="Logo" class="navbar-logo">
                <span class="navbar-text ms-2">TODOLIST WEB</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
     </nav>

    <section id="home" class="welcome-section text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to To-Do List System</h1>
            <p class="lead mt-3">Here you can make a to-do list!</p>
            <div class="mt-4">
                <a href="login.php" class="btn btn-success me-2 btn-custom">Login</a>
                <a href="register.php" class="btn btn-primary btn-custom">Register</a>
            </div>
        </div>
    </section>

    <footer style="background-color: #191970;" class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="fw-bold mb-3 text-white">About Us</h4>
                    <p class="text-white">The Ten 10 is a unified platform for displaying to-do lists.</p>
                </div>
                <div class="col-md-4 footer-links">
                    <h4 class="fw-bold mb-3 text-white">Address</h4>
                    <p class="text-white">Jl. Scientia, Gading Serpong.</p>
                </div>
                <div class="col-md-4 footer-links">
                    <h4 class="fw-bold mb-3 text-white">Follow Us</h4>
                    <a href="https://youtube.com/@alyavirgiaaurelline3758?si=gp6g1OmlvnzipLPE" class="d-block text-white"><i class="fab fa-youtube"></i>Youtube</a>
                    <a href="https://www.instagram.com/alyavrgia/profilecard/?igsh=a2lqNHFqaXY1YXVz" class="d-block text-white"><i class="fab fa-instagram"></i>Instagram</a>
                </div>
            </div>
            <p class="text-center mt-3 text-white">&copy; 2024 The Ten 10. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>