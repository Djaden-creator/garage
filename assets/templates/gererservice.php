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

</head>

<body>

    <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Garage</span>V.parrot </a>

        <nav class="navbar">
            <a href="../../index.php">home</a>
            <?php
            require '../function/userclass.php';
               if(isset($_SESSION['username'])){
             ?>
            <a href="profil.php"> <i class="far fa-user"></i><?php echo $_SESSION['username'];?></a>
            <?php
            } ?>
            <?php
               if(isset($_SESSION['email'])){
             ?>
            <a href="profil.php"><?php echo $_SESSION['email'];?></a>
            <?php
            } ?>
        </nav>
        <div id="logout">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>
    <section class="reviews" id="reviews" style="margin-top:100px;">
        <h1 class="heading">mes <span>services</span>
            (<?php
            require '../function/serviceClass.php';
              $counts= new ServiceClass();
              $counts->countserviceRow();
             ?>)
        </h1>
        <?php
              $counts->deleteService();
             ?>
        <div class="box-container">
            <!-- les services -->
            <?php
              $counts= new ServiceClass();
              $counts->fetchAllservice();
             ?>
            <!-- les services end -->
        </div>
    </section>
    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script src="../js/js.js"></script>

</body>

</html>