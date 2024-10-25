<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $user_id = $_SESSION['user_id'];
    $status = 'incomplete'; 

    $stmt = $conn->prepare("INSERT INTO todos (title, user_id, status) VALUES (?, ?, ?)");
    $stmt->execute([$title, $user_id, $status]);

    header("Location: dashboard.php");
    exit();  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To-Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
         body {
            background: url('uploads/bg-add.jpg') no-repeat center top;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            flex-direction: column;
            overflow: hidden; 
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 470px;
            margin-left: 10px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .card-header {
            background-color: #7C0A02;
            color: white;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-header h2 {
            font-weight: 600;
            font-size: 22px;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-label {
            color: #7C0A02;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #ccc;
            border-radius: 15px;
            padding: 10px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #7C0A02;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #7C0A02;
            border: none;
            padding: 10px;
            font-size: 14px;
            border-radius: 30px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        .card-footer {
            text-align: center;
            padding: 10px;
        }

        .card-footer a {
            color: #7C0A02;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-footer a:hover {
            color: #c0392b;
        }

        @media (max-width: 576px) {
            .card {
                max-width: 90%;
                margin: 0 10px;
            }

            .card-header h2 {
                font-size: 18px;
            }

            .form-control {
                padding: 8px;
                font-size: 13px;
            }

            .btn-primary {
                font-size: 13px;
                padding: 8px;
            }

            .card-footer a {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                <h2>Add New To-Do</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">To-Do Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your to-do title" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add To-Do</button>
                </form>
            </div>
            <div class="card-footer">
                <a href="dashboard.php">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>