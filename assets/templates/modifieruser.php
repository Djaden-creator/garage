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
            $auth= new UserAuth();
            $auth->login();
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
    <!-- section detail user -->
    <?php
       $dsn = 'mysql:host=localhost;dbname=garage';
       $username = 'root';
       $password = getenv('');
      try{
          //Récupérer l'url du produit
          $id=$_GET['id'];
          $pdo = new PDO($dsn, $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          $query = "SELECT * FROM users where  idUser='$id'";
          $stmt = $pdo->query($query);
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($items as $rows){
            ?>
    <section class="reviews" id="reviews" style="margin-top:100px;">

        <?php
                $auth->updateUser();
              ?>
        <div class="box-container">
            <!-- here the details of users start-->
            <div class="box">
                <img src="<?php echo $rows['image']?>" alt="" style="height:193px;width:190px;object-fit:contain;">
                <div class="content">
                    <p style="font-size:15px">name:<?php echo $rows['name']?></p>
                    <h3>email:<?php echo $rows['email']?></h3>
                    <h3>username:<?php echo $rows['username']?></h3>
                    <?php
                      if($rows['idUser']==1){
                        ?>
                    <div class="publicitem">
                        <button class="btn">status:administrateur</button>
                    </div>
                    <?php
                      }else{
                        ?>
                    <div class="publicitem">
                        <button class="btn">status:employé</button>
                    </div>
                    <?php
                      }
                    ?>
                </div>
            </div>
            <!-- here the details of users end -->
            <div class="box">

                <?php
                      if($rows['idUser']==1){
                        ?>
                <h3>admin profil</h3>
                <?php
                      }else{
                        ?>
                <h3>modifier votre employé</h3>
                <?php
                      }
                    ?>
                <?php
                 require '../function/modifierpictureuser.php';
                 require '../function/modifierpassw.php';
                 ?>
                <form action="" method="post">
                    <input type="hidden" name="getid" value="<?php echo $id?>" class="box">
                    <input type="text" name="username" value="<?php echo $rows['username']?>" class="box">
                    <input type="text" name="name" value="<?php echo $rows['name']?>" class="box">
                    <input type="email" name="email" value="<?php echo $rows['email']?>" class="box">
                    <input type="text" name="numero" value="<?php echo $rows['numero']?>" class="box">
                    <input type="text" name="pays" value="<?php echo $rows['pays']?>" class="box">
                    <input type="text" name="adress" value="<?php echo $rows['adress']?>" class="box">
                    <button type="submit" name="updateuser" class="btn">valider</button>
                </form>
                <button class="btn" id="modifierphoto" value="<?php echo $id?>">modifier sa photo de profil</button>
                <button class="btn" id="modifierpass" value="<?php echo $id?>">modifier pon password</button>
                <div id="formherephoto<?php echo $id?>"></div>
                <div id="formpassw<?php echo $id?>"></div>
            </div>
        </div>
    </section>
    <?php
    }
   }
    catch(PDOException $e){
    echo "error";
    }
    ?>
    <!-- section detail user ends retrieve par php -->
    <section class="featured" id="featured">

        <h1 class="heading"> <span>mes</span> publications (
            <?php
            require '../function/itemClass.php';
             $ItemProduct= new ItemProduct();
              $ItemProduct->countproductRow();
            ?>
            ) </h1>

        <div class="box-container">
            <!-- implementation des articles -->
            <?php
              $ItemProduct= new ItemProduct();
              $ItemProduct->retrieveItemforadmin();
            ?>
            <!-- implementation des article end -->
        </div>
    </section>
    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {

        //ici on ouvre la form pour modifier la photo du profil user
        $(document).on('click', '#modifierphoto', function openform() {
            let $this = $(this).val();
            let iduser = $(this).val();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/formuser.php",
                data: {
                    iduser: iduser,
                    updatepicture: 1
                },
                success: function(response) {
                    $('#formherephoto' + iduser).html(response);
                }
            });
        })
        //ici on cache le formulaire pour modifier la photo du profil:
        $(document).on('click', '#closebottom', function closebottom() {
            let $this = $(this).val();
            let iduser = $(this).val();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/formuser.php",
                data: {
                    iduser: iduser,
                    updatepicture: 1
                },
                success: function(response) {
                    $('#formherephoto' + iduser).html(hide);
                }
            });
        })
        //ici on va ouvrir le formulaire pour update le mot de pass
        $(document).on('click', '#modifierpass', function passupdate() {

            let $this = $(this).val();
            let iduser = $(this).val();

            $.ajax({
                type: "POST",
                url: "../ajaxPhp/updatepassw.php",
                data: {
                    iduser: iduser,
                    updatepass: 1
                },
                success: function(response) {
                    $('#formpassw' + iduser).html(response);
                }
            });
        })

        //ici on va fermer le formulaire pour update le mot de pass
        $(document).on('click', '#closeform', function passclose() {

            let $this = $(this).val();
            let iduser = $(this).val();

            $.ajax({
                type: "POST",
                url: "../ajaxPhp/updatepassw.php",
                data: {
                    iduser: iduser,
                    updatepass: 1
                },
                success: function(response) {
                    $('#formpassw' + iduser).html(hide);
                }
            });
        })
    });
    </script>

</body>

</html>