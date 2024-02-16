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
            session_start();
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
        <div id="login-btn">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>
    <section class="connect">
        <div class="row">
            <form action="" method="post">
                <?php
               require '../function/serviceClass.php';
               $addservice=new ServiceClass();
               $addservice->updateService();

       $dsn = 'mysql:host=localhost;dbname=garage';
       $username = 'root';
       $password = getenv('');
      try{
          //Récupérer l'url du produit
          $id=$_GET['id'];
          $pdo = new PDO($dsn, $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          $query = "SELECT * FROM services where  serviceid='$id'";
          $stmt = $pdo->query($query);
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($items as $rows){
            ?>
                <h3>modifier le service n°<?php echo $rows['serviceid'] ?> </h3>
                <input type="hidden" name="getid" value="<?php echo $id ?>">
                <input type="text" name="service" value="<?php echo $rows['service'] ?>" class="box">
                <textarea name="description" class="box"><?php echo $rows['description'] ?></textarea>
                <input type="submit" name="updateservice" value="modifier" class="btn">
            </form>
            <?php
            }
        }catch(PDOException $e){
            echo "error"; 
        }
        ?>
        </div>
    </section>

    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>

</body>

</html>