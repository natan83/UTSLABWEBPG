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

$profileImage = $user['profile_image'] ? "uploads/" . htmlspecialchars($user['profile_image']) : 'default_profile_image.png';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image = null;

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $dest_path = 'uploads/' . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profile_image = $fileName; 
        }
    }

    $updateParams = [$username, $email];
    $updateSql = "UPDATE users SET username = ?, email = ?";

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateSql .= ", password = ?";
        $updateParams[] = $hashedPassword;
    }

    if ($profile_image) {
        $updateSql .= ", profile_image = ?";
        $updateParams[] = $profile_image;
    }

    $updateSql .= " WHERE id = ?";
    $updateParams[] = $user_id;

    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute($updateParams);

    header("Location: profile.php?success=Profile updated successfully");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
            flex-grow: 1;
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

        .form-label {
            font-weight: 600;
            color: #fff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 10px 15px;
            color: #fff;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: none;
            color: white;
        }

        button.btn {
            background: #0000CD;
            color: white;
            padding: 9px 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: none;
            transition: background-color 0.6s ease;
        }

        button.btn:hover {
            background-color: #0000FF;
        }

        .back-btn {
            background: #DF2800;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            transition: background-color 0.6s ease;
        }

        .back-btn:hover {
            background-color: #FF0800;
        }

        img.profile-img {
            border-radius: 50%;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            max-width: 150px;
        }

        h2 {
            font-weight: 600;
            text-align: center;
            color: white;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .transparent-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            max-width: 1000px;
            margin: auto;
        }

        input[type="file"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .custom-file-label {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 10px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            img.profile-img {
                max-width: 100px;
            }

            .transparent-card {
                max-width: 90%;
            }

            .navbar-text {
                font-size: 1.2rem;
                line-height: 60px; 
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <h2>Edit Profile</h2>
        <div class="transparent-card">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3 mt-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    
                    <label class="custom-file-label" for="profile_image">Choose File </label>
                    
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                    <br>
                    <?php if ($user['profile_image']): ?>
                        <img src="uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" class="profile-img">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password (leave blank if not changing)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn">Update Profile</button>
            </form>
        </div>

        <div class="text-center mt-5 mb-3">
            <a href="profile.php" class="back-btn">Back to Profile</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
