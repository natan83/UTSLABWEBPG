<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$userStmt = $conn->prepare("SELECT username, profile_image FROM users WHERE id = ?");
$userStmt->execute([$user_id]);
$user = $userStmt->fetch();

$defaultProfileImage = 'uploads/userprofile.jpg'; 
$profileImage = $user['profile_image'] ? 'uploads/' . htmlspecialchars($user['profile_image']) : $defaultProfileImage;

$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM todos WHERE user_id = ?";
$params = [$user_id];

if ($status && $status != 'Filter by status') { 
    if ($status !== 'Filter by status') {
        $query .= " AND status = ?";
        $params[] = $status;
    }
}

if ($search) {
    $query .= " AND title LIKE ?";
    $params[] = '%' . $search . '%';
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('uploads/bg-dash2.jpg') no-repeat center top; 
            background-size: cover; 
            background-position: 0px -20px; 
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
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
            background-color: rgba(0, 0, 0, 0.3); 
            z-index: 0;
        }
        .container {
            position: relative;
            z-index: 1; 
            padding: 20px; 
            height: calc(100vh - 80px);
            overflow-y: hidden; 
            overflow-y: scroll; 
            scrollbar-width: none; 
        }
        .container::-webkit-scrollbar {
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
        .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.8); 
            border: none;
        }
        .dropdown-item {
            color: #ff2400; 
        }
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .btn-success {
            background: #0000CD; 
            border: none;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #0000FF; 
        }
        .btn-success:active, .btn-success:focus {
            background-color: #0000FF !important; 
            box-shadow: none; 
        }
        .btn-primary {
            background-color: rgba(0, 0, 0, 0.6); 
            border-color: #960019; 
        }
        .btn-primary:hover {
            background-color: rgba(0, 0, 0, 0.6);
            color: white; 
        }
        .btn-primary:focus, .btn-primary:active {
            background-color: rgba(0, 0, 0, 0.6) !important; 
            border-color: #960019; 
            box-shadow: none; 
        }
        .btn-danger {
            background-color: #DF2800;
            border-radius: 20px;
            color: white; 
        }
        .btn-danger:hover {
            background-color: #FF0800;
            border-radius: 20px;
            color: white; 
        }
        .btn-danger:focus, .btn-danger:active {
            background-color: #FF0800 !important; 
            box-shadow: none; 
        }
        h2 {
            color: white;
            font-size: 36px;
            text-shadow: 2px 2px 5px black;
            margin-bottom: 20px; 
        }
        .list-group-item {
            background-color: rgba(0, 0, 0, 0.1); 
            color: white;
            border: 1px solid white;
            margin-bottom: 10px; 
            padding: 15px; 
            border-radius: 8px; 
            transition: background-color 0.3s;
        }
        .form-select,
        .form-control,
        .btn-primary {
            background-color: rgba(0, 0, 0, 0.6); 
            color: white;
            border-radius: 8px; 
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); 
        }
        .form-control:focus {
            background-color: rgba(0, 0, 0, 0.6); 
            color: white; 
            outline: none;
        }
        .form-select:focus,
        .form-control:focus {
            outline: none; 
            box-shadow: none;
            border: 1px solid white;
        }
        .main-content {
            margin-top: 80px; 
            height: calc(100vh - 80px); 
        }
        .text-white {
            color: white;
        }
        .text-blue {
            color: #6495ED; 
        }
        .custom-dropdown {
            background-color: rgba(0, 0, 0, 0.6) !important; 
            color: white !important; 
            border: 1px solid white !important; 
            padding: 6px; 
            border-radius: 8px; 
            width: 100%; 
            pointer-events: auto; 
        }
        .custom-dropdown:hover {
            background-color: rgba(0, 0, 0, 0.6) !important; 
            color: white !important; 
            border: 1px solid white !important; 
        }
        .custom-dropdown:focus,
        .custom-dropdown:active {
            background-color: rgba(0, 0, 0, 0.6) !important; 
            color: white !important; 
            border: 1px solid white !important; 
        }
        .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.8); 
            border: none; 
            border-radius: 8px; 
        }
        .dropdown-item {
            color: #ff2400; 
        }
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1); 
            color: white;
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $profileImage; ?>" alt="Profile" width="50" height="50" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container main-content"> 
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-message mb-4" style="background-color: rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 15px; display: flex; align-items: center;">
                    <img src="uploads/ikonwelcome.png" alt="Greeting Icon" style="width: 100px; height: 100px; margin-right: 10px;">
                    <h2 class="m-0" style="color: white; font-weight: 600; text-shadow: 1px 1px 3px black;">Hello, <?php echo htmlspecialchars($user['username']); ?>!</h2>
                </div>
                <a href="add_todo.php" class="btn btn-success mb-3">Add New Task</a>

                <form method="GET" class="row mb-4">
                <div class="col-md-4">
                    <div class="dropdown">
                        <button class="btn custom-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo isset($_GET['status']) && $_GET['status'] ? htmlspecialchars($_GET['status']) : 'Filter by status'; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="?status=Filter by status">All</a></li>
                            <li><a class="dropdown-item" href="?status=Completed">Completed</a></li>
                            <li><a class="dropdown-item" href="?status=Incomplete">Incomplete</a></li>
                        </ul>
                    </div>
                </div>

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search tasks" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Filter/Search</button>
                    </div>
                </form>

                <?php if (empty($todos)): ?>
                    <div class="alert alert-info">No tasks found. Try adding a new one or adjusting your filter/search.</div>
                <?php else: ?>
                    <ul class="list-group">
                        <?php foreach ($todos as $todo): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong><?php echo htmlspecialchars($todo['title']); ?></strong> - 
                                <span class="<?php echo $todo['status'] == 'completed' ? 'text-blue' : 'text-white'; ?>">
                                    <?php echo htmlspecialchars($todo['status']); ?>
                                </span>
                            </span>
                                <div>
                                    <?php if ($todo['status'] == 'incomplete'): ?>
                                        <a href="complete_todo.php?id=<?php echo $todo['id']; ?>" class="btn btn-success btn-sm">Complete</a>
                                    <?php endif; ?>
                                    <a href="delete_todo.php?id=<?php echo $todo['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>