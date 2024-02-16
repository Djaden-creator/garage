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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>

    <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Garage</span>V.parrot </a>

        <nav class="navbar">
            <a href="../../index.php">home</a>
            <?php
             require '../function/userclass.php';
            if(isset ($_SESSION['email'])){
             ?>
            <a href="profil.php"> <i class="far fa-user"></i> <?php echo $_SESSION['email'] ?></a>
            <?php
            } ?>
        </nav>
        <?php if (isset ($_SESSION['email'])){
            ?>
        <div id="logout">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>
        <?php
        }else{
            ?>
        <a href="login.php">
            <div id="login-btn">
                <a href="login.php"><button class="btn"><i class="far fa-bell"></i>me connecter</button></a>
                <i class="far fa-user"></i>
            </div>
        </a>
        <?php
        } ?>


    </header>
    <section class="reviews" id="reviews">

        <h1 class="heading"> client's <span>review</span> </h1>
        <div class="box-container">
            <!-- temoignages des client -->
            <?php
               require '../function/temoignageClass.php';
               $temoignage= new ClientTemoignage();
               $temoignage->temoignageClient();
            ?>
            <!-- temoignages des client -->
        </div>
    </section>
    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script>
    //to approuve the comment valider un temoignage d'un client
    $(document).on('click', '#nonapprouver', function nonapprouver() {
        var $this = $(this);
        var nonapprouv = $(this).val();
        $.ajax({
            type: "POST",
            url: "../function/approuved.php",
            data: {
                nonapprouv: nonapprouv,
                pressone: 1
            },
            success: function(response) {
                $('#time' + nonapprouv).html(response);
                $('#hidebtn' + nonapprouv).html("");
            }
        });
    })
    //to desapprouve the comment devalider un temoignage d'un client:
    $(document).on('click', '#approuver', function approuver() {
        var $this = $(this);
        var approuv = $(this).val();
        $.ajax({
            type: "POST",
            url: "../function/desapprouved.php",
            data: {
                approuv: approuv,
                desapprouv: 1
            },
            success: function(response) {
                $('#time' + approuv).html(response);
                $('#hidebtntwo' + approuv).html("");

            }
        });
    })
    </script>

</body>

</html>