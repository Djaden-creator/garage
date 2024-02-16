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
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>

    <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Garage</span>V.parrot </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#services">services</a>
            <a href="#featured">featured</a>
            <a href="#reviews">reviews</a>
            <a href="#contact">contact</a>
            <?php
            require 'assets/function/userclass.php';
            if(isset ($_SESSION['username'])){
             ?>
            <a href="assets/templates/profil.php"> <i class="far fa-user"></i> <?php echo $_SESSION['username'] ?></a>
            <?php
            } ?>
        </nav>
        <?php if (isset ($_SESSION['username'])){
            ?>
        <div id="logout">
            <a href="assets/templates/logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>
        <?php
        }else{
            ?>
        <a href="assets/templates/login.php">
            <div id="login-btn">
                <button class="btn"><i class="far fa-bell"></i>me connecter</button>
                <i class="far fa-user"></i>
            </div>
        </a>
        <?php
        } ?>


    </header>
    <section class="home" id="home">
        <h3>Nous sommes votre premier site de vente de voiture occasion</h3>

        <img src="assets/image/car2.png" alt="">
    </section>

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

    <section class="services" id="services">

        <h1 class="heading"> our <span>services</span> </h1>

        <div class="box-container">
            <?php
            require 'assets/function/serviceClass.php';
            $counts= new ServiceClass();
            $counts->visitorService();
          ?>
        </div>

    </section>

    <section class="featured" id="featured">
        <h1 class="heading"> <span>nos voitures</span> d'occasion(
            <?php
             require 'assets/function/itemClass.php';
             $item= new ItemProduct();
              $item->countproductRow();
            ?>
            ) </h1>
        <div class="box-container">
            <div class="">
                <div style="padding: 10px 20px;">
                    <h5 style="font-size:20px">trier par Prix</h5>
                    <input type=" hidden" id="minprice">
                    <input type="hidden" id="maxprice">
                    <div id="price_range" style="font-size:12px"></div>
                    <div id="priceshow" style="font-size:12px"></div>

                </div>
            </div>
            <div class="">
                <div style="padding: 10px 20px;">
                    <h5 style="font-size:20px">trier par kilometre</h5>
                    <input type=" hidden" id="minkilometre">
                    <input type="hidden" id="maxkilometre">

                    <div id="kilometre_range" style="font-size:12px"></div>
                    <div id="kilometreshow" style="font-size:12px"></div>
                </div>
            </div>
            <div class="">
                <div style="padding: 10px 20px;">
                    <h5 style="font-size:20px">trier par annee</h5>
                    <input type=" hidden" id="minannee" value="1990">
                    <input type="hidden" id="maxannee">
                    <div id="annee_range" style="font-size:12px"></div>
                    <div id="anneeshow" style="font-size:12px"></div>
                </div>
            </div>
        </div>


        <div class="box-container" id="dynamic">

            <?php
             $item= new ItemProduct();
              $item->visitorProduct();
            ?>
        </div>
    </section>

    <section class="reviews" id="reviews">
        <h1 class="heading"> client's <span>review</span> </h1>
        <div class="box-container">
            <?php
             require 'assets/function/temoignageClass.php';
              $client= new ClientTemoignage();
             $client->allreviews();
          ?>
        </div>
    </section>

    <section class="contact" id="contact">

        <h1 class="heading"><span>contact</span> us</h1>
        <div style="padding:10px 20px">
            <?php
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

    <section class="footer" id="footer">

        <div class="box-container">

            <div class="box">
                <h3>nos horraires</h3>
                <?php
          require 'assets/function/horraire.php';
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
    <script src="assets/js/js.js"></script>


    <!-- jquery and ajax  -->
    <script>
    $(document).ready(function() {
        //range par prix
        function filter_data() {
            let minprice = $('#minprice').val();
            let maxprice = $('#maxprice').val();
            //alert(minprice + maxprice);
            $.ajax({
                url: "assets/ajaxPhp/filter_price.php",
                method: "POST",
                data: {
                    minprice: minprice,
                    maxprice: maxprice,
                },
                success: function(data) {
                    $('#dynamic').html(data);
                }
            })
        }
        $('.common_selector').click(function() {})
        //range du prix
        $('#price_range').slider({
            range: true,
            min: 1000,
            max: 2000000,
            values: [1000, 2000000],
            step: 500,
            stop: function(event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $('#priceshow').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#minprice').val(ui.values[0]);
                $('#maxprice').val(ui.values[1]);
                filter_data();
            }
        });
        //range par kilometre
        function filter_kilometre() {
            let minkilometre = $('#minkilometre').val();
            let maxkilometre = $('#maxkilometre').val();

            //alert(minprice + maxprice);
            $.ajax({
                url: "assets/ajaxPhp/filter_kilometre.php",
                method: "POST",
                data: {
                    minkilometre: minkilometre,
                    maxkilometre: maxkilometre,
                },
                success: function(data) {
                    $('#dynamic').html(data);
                }
            })
        }
        //range du kilometre
        $('#kilometre_range').slider({
            range: true,
            min: 0,
            max: 1000000,
            values: [0, 1000000],
            step: 100,
            stop: function(event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $('#kilometreshow').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#minkilometre').val(ui.values[0]);
                $('#maxkilometre').val(ui.values[1]);
                filter_kilometre();
            }
        });

        //filtrer par annee
        function filter_annee() {
            let minannee = $('#minannee').val();
            let maxannee = $('#maxannee').val();

            //alert(minprice + maxprice);
            $.ajax({
                url: "assets/ajaxPhp/filter_annee.php",
                method: "POST",
                data: {
                    minannee: minannee,
                    maxannee: maxannee,
                },
                success: function(data) {
                    $('#dynamic').html(data);
                }
            })
        }
        //filtrer par annee
        $('#annee_range').slider({
            range: true,
            min: 1990,
            max: 2024,
            values: [1990, 2024],
            step: 1,
            stop: function(event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $('#anneeshow').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#minannee').val(ui.values[0]);
                $('#maxannee').val(ui.values[1]);
                filter_annee();
            }
        });

        //ici c pour faire un dm a l'administrateur du site contact 
        $(document).on('click', '#sendmessage', function sendmessage() {
            event.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let numero = $('#numero').val();
            let message = $('#message').val();
            $.ajax({
                type: "POST",
                url: "assets/ajaxPhp/messageSans_id.php",
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
                url: "assets/ajaxPhp/sendReview.php",
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