<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel ="stylesheet" href="stylemain.css">
    <title>Contact | Naig</title>
    <link rel="icon" type="image/png" href="colinIcon.png">
</head>
<body>
    <!-- HEADER SECTION -->
    <header class = "header">
        <a href ="index.php" class="logo">Colinz</a>
        
        <i class="fa-solid fa-bars" id="menu-icon"></i>
        
        <nav class ="navbar">
            <a href ="index.php" class="active">Home</a>
            <a href ="about.php">About</a>
            <a href ="education.php">Education</a>
            <a href ="achievements.php">Achievements</a>
            <a href ="#contact">Contact</a>
            <a href ="logout.php">Logout</a>
        </nav>
    </header>
    
    <!-- CONTACT SECTION -->
    <section class="contact" id="contact">
        <h2 class ="heading">Contact <span>Me</span></h2>

        <form action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="00f05c25-4949-48c2-91cb-83d698ee14a5">
            <div class="input-box">
                    <input type="text" name="Name" placeholder="Full Name">
                    <input type="email" name="email" placeholder="Email Address">
            </div>
            <div class="input-box">
                <input type="text" name="number" placeholder="Mobile Number">
                <input type="text" name="subject" placeholder="Email Subject">
            </div>
            <textarea name="Message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <input type="submit" value="Send Message" class="btn">
        </form>
    </section>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="script.js"></script>
</body>
</html>