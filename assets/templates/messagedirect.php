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
                <button class="btn"><i class="far fa-bell"></i>me connecter</button>
                <i class="far fa-user"></i>
            </div>
        </a>
        <?php
        } ?>
    </header>
    <br><br><br><br>
    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-home"></i>
            <div class="content">
                <h3>150+</h3>
                <p>branches</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-car"></i>
            <div class="content">
                <h3>4770+</h3>
                <p>cars sold</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <div class="content">
                <h3>320+</h3>
                <p>happy clients</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-car"></i>
            <div class="content">
                <h3>1500+</h3>
                <p>news cars</p>
            </div>
        </div>

    </section>
    <section class="contact" id="contact">
        <h1 class="heading"><span>contact</span> us</h1>
        <div class="row">
            <?php
       $dsn = 'mysql:host=localhost;dbname=garage';
       $username = 'root';
       $password = getenv('');
      try{
          //Récupérer l'url du produit
          $id=$_GET['id'];
          $pdo = new PDO($dsn, $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          $query = "SELECT * FROM item where  idItem='$id'";
          $stmt = $pdo->query($query);
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($items as $rows){
            ?>
            <form>
                <h3>envoyez un message</h3>
                <h5 id="showmessage"></h5>
                <input type="hidden" value="<?php echo $id; ?>" id="item" placeholder="your name" class="box">
                <input type="text" id="name" placeholder="your name" class="box">
                <input type="email" id="email" placeholder="your email" class="box">
                <input type="text" id="numero" placeholder="numero" class="box">
                <textarea placeholder="your message" id="message" class="box" cols="30" rows="10"></textarea>
                <button id="sendmessage" class="btn">send message</button>
            </form>
            <?php
            }
      }catch(PDOException $e){
        echo"error:".$e->getMessage();
      } ?>
        </div>

    </section>

    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>

    <!-- jquery and ajax  -->
    <script>
    $(document).ready(function() {
        //ici c pour faire un message a l'administrateur du site contact
        $(document).on('click', '#sendmessage', function sendmessage() {
            event.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let numero = $('#numero').val();
            let message = $('#message').val();
            let item = $('#item').val();

            $.ajax({
                type: "POST",
                url: "../ajaxPhp/messageWithid.php",
                data: {

                    name: name,
                    email: email,
                    numero: numero,
                    message: message,
                    item: item,
                    direct: 1
                },
                success: function(response) {
                    $('#showmessage').html(response);
                }
            });
        });

        //end
    });
    </script>

</body>

</html>