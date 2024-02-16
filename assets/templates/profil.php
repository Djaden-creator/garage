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

        <a href="#" class="logo"><span>Garage</span>V.parrot </a>

        <nav class="navbar">
            <a href="../../index.php">home</a>
            <?php
              require '../function/userclass.php';
              $auth= new UserAuth();
              $auth->login();
               if(isset ($_SESSION['username'])){
             ?>
            <a href="profil.php"> <i class="far fa-user"></i> <?php echo $_SESSION['username'] ?></a>

            <!-- messaage non repondu -->
            <?php
              $dsn ='mysql:host=localhost;dbname=garage';
              $username = 'root';
               $password = getenv('');
               try{
              $pdo = new PDO($dsn,$username,$password);
              $sql="SELECT * FROM users";
              $stmt = $pdo->query($sql);
                if(isset($_SESSION['idUser'])){
                    if($_SESSION['idUser']==1){
                    ?>
            <a href="fechmessage.php"
                style="padding:5px 10px;background-color:brown;color:white;border-radius:10px 20px;font-size:12px;">
                new message
                <span style="background-color:#000000;border-radius:3px;padding:3px;color:white;">
                    <?php
        require '../function/messageClass.php';
        $newmessage= new ClientMessage();
        $newmessage->countmessageRow();
        ?>
                </span></a>
            <!-- message non repondu end -->

            <!-- message repondu -->
            <a href="respondedmessage.php"
                style="padding:5px 10px;background-color:brown;color:white;border-radius:10px 20px;font-size:12px;">
                messages repondu
                <span style="background-color:#000000;border-radius:3px;padding:3px;color:white;">
                    <?php
        $newmessage->countoldMessage();
        ?>
                </span></a>
            <!-- message repondu end  -->

            <?php
                }else{
                    if(isset ($_SESSION['email'])){
                   ?>
            <a href="profil.php"><?php echo $_SESSION['email'] ?></a>
            <?php
                }
            }
            }
                  }catch(PDOException $e){
                    file_put_contents('../ajaxPhp/dblogs.log', $e->getMessage().PHP_EOL, FILE_APPEND);
                    echo "oups impossible de nous connecter";
                  }
            ?>
            <?php
             }?>
        </nav>
        <div id="logout">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>
    <!-- section detail user -->
    <section class="reviews" id="reviews" style="margin-top:100px;">

        <h1 class="heading"> Mon <span>Profil</span> </h1>
        <h1 style="color:red;padding:10px;">
            <?php
        require '../function/itemClass.php';
        $item= new ItemProduct();
        $item->itemPr();
        ?> </h1>
        <h1 style="color:red;padding:10px;">
            <?php
                 $auth->signUPuser();
        ?>
        </h1>

        <div class="box-container">
            <!-- here the details of users start-->
            <?php
                 $auth->userDetail();
            ?>
            <!-- here the details of users end -->

            <!-- form for article entry -->
            <div class="item">
                <div class="box" id="recordpeople">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>enregistrez votre voiture</h3>
                        <p style="font-size:15px;">NB:ne mettez pas le signe de dollard sur le prix</p>
                        <input type="text" name="name" placeholder="voiture" class="box">
                        <input type="text" name="kilometre" placeholder="kilometre" class="box">
                        <input type="text" name="annee" placeholder="annee" class="box">
                        <input type="text" name="prix" placeholder="prix" class="box">
                        <textarea name="description" placeholder="description" class="box"></textarea>
                        <input type="file" name="picture" placeholder="image">
                        <button type="submit" name="itemfill" class="btn">valider</button>
                    </form>

                </div>
            </div>
            <!-- form for article entry -->

            <!-- form of entry user -->
            <div class="userentry">
                <div class="box">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                        enctype="multipart/form-data" class="formreg">
                        <h3>enregistrez un employé</h3>
                        <input type="text" name="username" placeholder="username" class="box">
                        <input type="text" name="name" placeholder="name" class="box">
                        <input type="email" name="email" placeholder="email" class="box">
                        <input type="text" name="numero" placeholder="numero" class="box">
                        <input type="text" name="pays" placeholder="pays" class="box">
                        <input type="text" name="adress" placeholder="adresse" class="box">
                        <input type="password" name="password" placeholder="password" class="box">
                        <i class="fas fa-eye"></i>
                        <input type="file" name="image" placeholder="image">
                        <button type="submit" name="userfill" class="btn">valider</button>
                    </form>

                </div>
            </div>
            <!-- form of entry user -->
        </div>
    </section>

    <!-- section detail user ends retrieve par php -->
    <section class="featured" id="featured">

        <h1 class="heading"> <span>mes</span> publications (
            <?php
              $item->countproductUser();
            ?>
            ) </h1>

        <div class="box-container">
            <!-- implementation des articles -->
            <?php
              $item->retrieveItem();
            ?>
            <!-- implementation des article end -->
        </div>
    </section>
    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script src="../js/showpassword.js"></script>
</body>

</html>