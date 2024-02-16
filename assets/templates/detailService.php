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
                <button class="btn"><i class="far fa-bell"></i>contact us</button>
                <i class="far fa-user"></i>
            </div>
        </a>
        <?php
        } ?>


    </header>
    <section class="services" id="services">

        <h1 class="heading"> our <span>services</span> </h1>

        <div class="box-container">

            <?php
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
            <div class="box">
                <i class="fas fa-car"></i>
                <h3><?php echo $rows['service'] ?></h3>
                <p><?php echo $rows['description'] ?></p>
            </div>
            <?php
          }
        }catch(PDOException){

          }
         ?>
        </div>

    </section>
    <!-- contact -->
    <section class="contact" id="contact">

        <h1 class="heading"><span>contact</span> us</h1>
        <div style="padding:10px 20px">
            <?php
             require '../function/temoignageClass.php';
             $client= new ClientTemoignage();
             $client->temClient();
            ?>
        </div>

        <div class="row">
            <form>
                <h3>deposer un commentaire</h3>
                <h5 id="showmessagereview"></h5>
                <input type="text" id="namereviewer" placeholder="your name" class="box">
                <select id="pets" class="box">
                    <option value="">--votre note--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <textarea placeholder="your message" id="commentreview" class="box">description</textarea>
                <button id="sendreview" class="btn">valider</button>
            </form>
            <form>
                <h3>envoyez un message</h3>
                <h5 id="showmessage"></h5>
                <input type="text" id="name" placeholder="your name" class="box">
                <input type="email" id="email" placeholder="your email" class="box">
                <input type="text" id="numero" placeholder="numero" class="box">
                <textarea placeholder="your message" id="message" class="box" cols="30" rows="10"></textarea>
                <button id="sendmessage" class="btn">send message</button>
            </form>

        </div>

    </section>
    <!-- contact end -->
    <!-- reviews -->
    <section class="reviews" id="reviews">

        <h1 class="heading"> client's <span>review</span> </h1>

        <div class="box-container">
            <?php
              $client= new ClientTemoignage();
             $client->reviews();
          ?>
        </div>
    </section>

    <?php
     require 'footer.php';
    ?>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script>
    $(document).ready(function() {
        //ici c pour faire un dm a l'administrateur du site contact 
        $(document).on('click', '#sendmessage', function sendmessage() {
            event.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let numero = $('#numero').val();
            let message = $('#message').val();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/messageSans_id.php",
                data: {
                    name: name,
                    email: email,
                    numero: numero,
                    message: message,
                    direct: 1
                },
                success: function(response) {
                    $('#showmessage').html(response);
                }
            });
        });

        //enregistrer de temoignages ou reviens de client:

        $(document).on('click', '#sendreview', function sendreview() {
            event.preventDefault();
            let namereviewer = $('#namereviewer').val();
            let pets = $('#pets').val();
            let commentreview = $('#commentreview').val();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/sendReview.php",
                data: {
                    namereviewer: namereviewer,
                    pets: pets,
                    commentreview: commentreview,
                    reviewsend: 1
                },
                success: function(response) {
                    $('#showmessagereview').html(response);
                }
            });
        })
    });
    </script>

</body>

</html>