<!DOCTYPE html>
<html lang="en">

<head>
    <!-- referencement -->
    <Meta name="robots " content="index, follow" />
    <meta name="la gestion" content="meilleur garage">
    <meta property="og:la gestion" content="LA GESTION DES garages" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/password.css">

</head>

<body>

    <header class="header">
        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Garage</span>V.parrot </a>

        <nav class="navbar">
            <a href="../../index.php">home</a>
            <a href="about.php"> <i class="far fa-user"></i> about us</a>
        </nav>
        <div id="login-btn">
            <button class="btn"><i class="far fa-bell"></i>me connecter</button>
            <i class="far fa-user"></i>
        </div>

    </header>
    <section class="connect">
        <div class="row">
            <h1><span>login</span> us</h1>
            <?php
               require '../function/userclass.php';
               $auth= new UserAuth();
               $auth->login();
            ?>
            <form method="post" class="formlog">
                <h3>get in touch</h3>
                <input type="email" name="email" placeholder="your email" class="box">
                <input type="password" name="password" placeholder="password" class="box">
                <i class="fas fa-eye"></i>
                <input type="submit" name="signup" value="send message" class="btn">
                <p style="margin-top: 10px;"><a href="">mot de passe oublier?</a></p>
            </form>

        </div>
    </section>

    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/password.js"></script>

</body>

</html>