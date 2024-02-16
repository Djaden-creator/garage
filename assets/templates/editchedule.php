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
        <div id="login-btn">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>
    <section class="connect">

        <div class="row">
            <form action="" method="post">
                <?php
                 require '../function/horraire.php';
                 $chedule= new HorraireGarage();
                 $chedule->updateChedule();
       $dsn = 'mysql:host=localhost;dbname=garage';
       $username = 'root';
       $password = getenv('');
      try{
          //Récupérer l'url du produit
          $id=$_GET['id'];
          $pdo = new PDO($dsn, $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          $query = "SELECT * FROM horraire where  horraireid='$id'";
          $stmt = $pdo->query($query);
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($items as $rows){
            ?>
                <h3>regler mon horraire</h3>
                <input type="hidden" name="getid" value="<?php echo $rows['horraireid']?>">
                <input type="text" name="jour" value="<?php echo $rows['jour']?>" placeholder="taper votre jour"
                    class="box">
                <span>matin:</span>
                <input type="time" name="commence" value="<?php echo $rows['heureDebut']?>" placeholder="debut"
                    class="box">
                <input type="time" name="fin" value="<?php echo $rows['heureFin']?>" placeholder="fin" class="box">
                <span>midi:</span>
                <input type="time" name="mididebut" value="<?php echo $rows['mididebut']?>" placeholder="debut"
                    class="box">
                <input type="time" name="midifin" value="<?php echo $rows['midifin']?>" placeholder="fin" class="box">
                <textarea name="description" class="box"><?php echo $rows['description']?></textarea>
                <button type="submit" name="updatehorraire" class="btn">update</button>
            </form>
            <?php
            }
}catch(PDOException $e){
 echo"no database";
}
?>
        </div>
    </section>

    <section class="footer" id="footer">

        <div class="box-container">

            <div class="box">
                <h3>nos horraires</h3>
                <?php
  $chedule= new HorraireGarage();
  $chedule->getChedule();
 ?>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> vehicules </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> services </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> featured </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> reviews </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> contact </a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <?php            
  $auth= new UserAuth();
  $auth->contactEtablissement();
 ?>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
                <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
            </div>

        </div>

        <div class="credit"> cree par kibelisa kife eden | all rights reserved </div>

    </section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>

</body>

</html>