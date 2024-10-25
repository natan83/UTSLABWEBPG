<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        overflow-y: scroll;
        overscroll-behavior: contain;
        scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
        display: none; 
    }

    body {
        background-color: #f7f9fc;
        font-family: 'Poppins', sans-serif;
        color: #333;
        display: flex;
        flex-direction: column;
    }

    header {
        background: linear-gradient(135deg, #2a5298, #1e3c72);
        color: white;
        text-align: center;
        padding: 60px 20px;
        animation: fadeIn 1s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    header h1 {
        font-size: 3em;
        margin: 0;
        font-weight: bold;
        letter-spacing: 1px;
    }

    header p {
        font-size: 1.2em;
        margin: 15px 0 20px;
        font-weight: 300;
    }

    header img {
        margin-top: 30px;
        width: 150px;
        border-radius: 10px;
    }

    .hiasan-img {
        position: absolute;
        top: -30px;
        right: 0;
        width: 200px;
        height: auto;
        border-radius: 20px;
        opacity: 0.7;
        z-index: 0;
    }

    .back-arrow {
        position: absolute;
        top: 25px;
        left: 25px;
        font-size: 1.8em;
        color: white;
        text-decoration: none;
        transition: transform 0.3s, color 0.3s;
    }

    .back-arrow:hover {
        transform: translateX(-5px);
        color: #f7f9fc;
    }

    .team {
        max-width: 1200px;
        margin: 50px auto;
        padding: 50px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    }

    .team h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5em;
        color: #2a5298;
        font-weight: bold;
    }

    .team-member {
        text-align: center;
        margin: 20px 0;
        transition: transform 0.3s, box-shadow 0.3s;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .team-member img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .team-member h3 {
        margin-top: 15px;
        font-size: 1.4em;
        color: #333;
        font-weight: 600;
    }

    .team-member p {
        color: #777;
        font-weight: 300;
    }

    .text-center img {
        max-width: 100%;
        height: auto;
    }

    footer {
        text-align: center;
        padding: 25px;
        background-color: #2a5298;
        color: white;
        font-size: 1.1em;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    footer p {
        margin: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        header h1 {
            font-size: 2.2em;
        }

        .team h2 {
            font-size: 2em;
        }

        .team-member {
            margin: 10px 0;
        }
    }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
        <h1>About Us</h1>
        <img src="uploads/ten10.png" alt="Tentang Kami" class="img-fluid">
        <p>We are a web programming group that works on this to-do list website.</p>
        <img src="uploads/hiasan.png" alt="Hiasan" class="hiasan-img">
    </header>
    
    <main>
        <section class="team">
            <h2>Our Team</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="team-member">
                            <img src="uploads/rio.jpg" alt="Anggota Tim 1" class="img-fluid rounded-circle">
                            <h3>Rio Hawari Putra Hakim</h3>
                            <p>00000109470</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-member">
                            <img src="uploads/ale.jpg" alt="Anggota Tim 2" class="img-fluid rounded-circle">
                            <h3>Alya Virgia Aurelline</h3>
                            <p>00000111025</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-member">
                            <img src="uploads/lifkie.jpg" alt="Anggota Tim 3" class="img-fluid rounded-circle">
                            <h3>Lifkie <br> Lie</h3>
                            <p>00000081835</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-member">
                            <img src="uploads/natan.png" alt="Anggota Tim 4" class="img-fluid rounded-circle">
                            <h3>Natan Adi Chandra</h3>
                            <p>00000079860</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center">
            <img src="uploads/aboutus.jpg" alt="About Us" class="img-fluid">
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 The Ten 10. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>