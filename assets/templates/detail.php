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

        <a href="#" class="logo"><span>Garage</span>V.parrot </a>

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
        <?php
         if(isset($_SESSION['email'])){
            ?>
        <div id="logout">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>
        <?php
         }else{
            ?>
        <div id="logout">
            <a href="" class="btn">contact us</a>
            <i class="far fa-user"></i>
        </div>
        <?php
         }
        ?>


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
  
          $query = "SELECT * FROM item where  idItem='$id'";
          $stmt = $pdo->query($query);
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($items as $rows){
            ?>
    <section class="reviews" id="reviews" style="margin-top:100px;">
        <div class="box-container">
            <!-- here the details of users start-->
            <div class="box">
                <img src="<?php  echo $rows['image']?>" alt="image"
                    style="width:180px;height:300px;object-fit:contain;">
                <div class="content">
                    <p style="font-size:15px">marque:<?php echo $rows['voiture']?></p>
                    <h3>prix:<?php echo $rows['prix']?></h3>
                    <h3>année:<?php echo $rows['annee']?></h3>
                    <h3>kilometre:<?php echo $rows['kilometre']?></h3>
                    <a href="messagedirect.php?id=<?php echo $id;?>" class="btn">contact the admin</a>
                </div>
            </div>
            <!-- here the details of users end -->
            <div class="box">
                <div class="content">
                    <h3>description:<?php echo $rows['description']?></h3>
                    <h3>année:<?php echo $rows['annee']?></h3>
                    <h3><?php echo $rows['kilometre']?></h3>
                </div>

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

        <h1 class="heading"> <span>nos</span> publications (
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

    <script src="../js/js.js"></script>

</body>

</html>