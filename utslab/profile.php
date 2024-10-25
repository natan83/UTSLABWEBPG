<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$profileImage = $user['profile_image'] ? 'uploads/' . htmlspecialchars($user['profile_image']) : 'uploads/userprofile.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('uploads/bg-profile.jpg') no-repeat center top; 
            background-size: cover;
            color: white;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden; 
        }

        .content {
            height: 100%; 
            overflow-y: scroll;
            padding: 20px; 
            margin-top: 75px; 
            scrollbar-width: none;
        }

        .content::-webkit-scrollbar {
            display: none; 
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

        .card {
            background: rgba(255, 255, 255, 0.2); 
            border: none;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 50px;
            margin-top: 50px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .btn {
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 10px;
        }

        .btn-edit {
            background: #0000CD;
            color: white;
            transition: background-color 0.6s ease;
        }

        .btn-edit:hover {
            background: #0000FF; 
        }

        .btn-edit:active, .btn-edit:focus {
            background-color: #0000FF !important; 
            box-shadow: none; 
        }

        .btn-back {
            background: #DF2800; 
            color: white;
            transition: background-color 0.6s ease;
        }

        .btn-back:hover {
            background: #FF0800; 
        }

        .btn-back:active, .btn-back:focus {
            background-color: #FF0800 !important; 
            box-shadow: none; 
        }

        .btn:focus, .btn:active {
            outline: none; 
            box-shadow: none; 
            border: none;
        }

        .profile-image {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 5px solid #fff;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .profile-image:hover {
            transform: scale(1.1); 
        }

        @media (max-width: 768px) {
            .profile-image {
                width: 150px;
                height: 150px;
            }
        }

        h2 {
            font-weight: 600;
            font-size: 28px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        }

        .profile-detail {
            font-size: 18px;
            font-weight: 600;
            margin-top: 15px;
            color: #f0f0f0;
        }

        .profile-text {
            font-size: 16px;
            margin-top: 5px;
            color: #ccc;
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container mt-2">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                <div class="card text-center">
                    <div class="card-body">
                        <h2>User Profile</h2>
                        <img src="<?php echo $profileImage; ?>" alt="Profile Image" class="profile-image">
                        <div class="profile-detail">Username</div>
                        <p class="profile-text"><?php echo htmlspecialchars($user['username']); ?></p>
                        <div class="profile-detail">Email</div>
                        <p class="profile-text"><?php echo htmlspecialchars($user['email']); ?></p>
                        <a href="edit_profile.php" class="btn btn-edit">Edit Profile</a>
                        <a href="dashboard.php" class="btn btn-back">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>