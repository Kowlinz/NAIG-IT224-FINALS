<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel ="stylesheet" href="stylemain.css">
    <title>Home | Naig</title>
    <link rel="icon" type="image/png" href="colinIcon.png">
</head>
<body>
    <!-- HEADER SECTION -->
    <header class = "header">
        <a href ="index.php" class="logo">Colinz</a>
        
        <i class="fa-solid fa-bars" id="menu-icon"></i>
        
        <nav class ="navbar">
            <a href ="#home" class="active">Home</a>
            <a href ="about.php">About</a>
            <a href ="education.php">Education</a>
            <a href ="achievements.php">Achievements</a>
            <a href ="contact.php">Contact</a>
        </nav>
    </header>

    <!-- HOME SECTION -->
    <section class="home" id="home">
        <div class="home-content">
            <h3>Hello, Everyone</h3>
            <h1>I'm Yves Naig</h1>
            <h3>Your future <span class="multiple-text"></span></h3>
            <p>Welcome to my virtual space, where everything about me is here!</p>
            <div class="social-media">
                <a href="https://www.facebook.com/ibes.kulin" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/ibes.kulin/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://github.com/Kowlinz" target="_blank"><i class="fa-brands fa-github"></i></a>
            </div>
            <a href="about.php" class="btn">More Details!</a>
        </div>

        <div class="home-img">
            <img src="indexpic.jpg" alt="">
        </div>
    </section>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="script.js"></script>
</body>
</html>