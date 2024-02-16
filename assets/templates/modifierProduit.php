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
                    <h3><?php  echo $rows['voiture']?></h3>
                    <div class="price"><?php  echo $rows['kilometre']?> km</div>
                    <div class="price"><?php  echo $rows['annee']?></div>
                    <div class="price"><?php  echo $rows['prix']?> USD</div>
                    <?php
        if($rows['prix'] <= 3000){
            ?>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <?php
        }elseif($rows['prix'] <= 15000){
            ?>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <?php
        }elseif($rows['prix'] < 25000){
            ?>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <?php
        }elseif($rows['prix'] <= 100000){
            ?>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <?php
        }
        elseif($rows['prix'] >= 100000){
            ?>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php
        }else{
            ?>
                    <div class="stars">
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <?php
        }
        
        ?>
                </div>
            </div>
            <!-- here the details of users end -->
            <div class="box">
                <?php
                   require '../function/itemClass.php';
                   require '../function/modifierProductpicture.php';
                   $ItemProduct= new ItemProduct();
                   $ItemProduct->itemUpdate();
            
                  ?>
                <form action="" method="post">
                    <input type="email" name="getmail" value="<?php echo $rows['emailUser']?>" class="box">
                    <input type="hidden" name="getid" value="<?php echo $id?>" class="box">
                    <input type="text" name="voiture" value="<?php echo $rows['voiture']?>" class="box">
                    <input type="text" name="kilometre" value="<?php echo $rows['kilometre']?>" class="box">
                    <input type="text" name="annee" value="<?php echo $rows['annee']?>" placeholder="année" class="box">
                    <input type="text" name="prix" value="<?php echo $rows['prix']?>" placeholder="USD" class="box">
                    <textarea name="description" class="box"><?php echo $rows['description']?></textarea>
                    <button type="submit" name="updateItems" class="btn">valider</button>
                </form>
                <button class="btn" id="opn" value="<?php echo $id?>">changer sa photo</button>
                <div id="showform<?php echo $id?>"></div>
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
             $item= new ItemProduct();
              $item->countproductRow();
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
    <section class="footer" id="footer">

        <div class="box-container">

            <div class="box">
                <h3>nos horraires</h3>
                <?php
  require '../function/horraire.php';
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {

        //ici on open le formulaire pour la photo
        $(document).on('click', '#opn', function openit() {
            let $this = $(this).val();
            let iditem = $(this).val();

            $.ajax({
                type: "POST",
                url: "../ajaxPhp/productPictureform.php",
                data: {
                    iditem: iditem,
                    item: 1
                },
                success: function(response) {
                    $('#showform' + iditem).html(response);
                }
            });
        })
        //ici on ferme le formulaire:
        $(document).on('click', '#cloit', function closeit() {
            let $this = $(this).val();
            let iditem = $(this).val();

            $.ajax({
                type: "POST",
                url: "../ajaxPhp/productPictureform.php",
                data: {
                    iditem: iditem,
                    item: 1
                },
                success: function(response) {
                    $('#showform' + iditem).html("");
                }
            });
        })
    });
    </script>
</body>

</html>