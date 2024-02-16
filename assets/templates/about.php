<!DOCTYPE html>
<html lang="en">

<head>
    <!-- referencement -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Meta name="robots " content="index, follow" />
    <meta name="la gestion" content="meilleur garage">
    <meta property="og:la gestion" content="LA GESTION DES garages" />
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
            <a href="login.php"><button class="btn"><i class="far fa-bell"></i>me connecter</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>
    <section class="reviews" id="reviews" style="margin-top:100px;">

        <h1 class="heading">A<span>propos</span></h1>
        <div class="box-container">
            <!-- fetch all user -->
            <div class="box">
                <i class="fas fa-car"></i>
                <h1>Notre Garage</h1>
                <p style="font-size:18px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <br>
                <p style="font-size:18px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <br>
                <p style="font-size:18px;color:black">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <br>
                <p style="font-size:18px;color:black">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <br>
                <p style="font-size:18px;color:black">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>
            <!-- fetch all user -->
        </div>
    </section>
    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script src="../js/js.js"></script>

</body>

</html>