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

    <!-- mdb cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <!-- swiper cdn link -->
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
               if(isset ($_SESSION['email'])){
             ?>
            <a href="profil.php"> <i class="far fa-user"></i> <?php echo $_SESSION['email'] ?></a>
            <a href="profil.php"
                style="padding:5px 10px;background-color:brown;color:white;border-radius:10px 20px;font-size:12px;">
                message repondu
                <span style="background-color:#000000;border-radius:3px;padding:3px;color:white;">
                    <?php
        require '../function/messageClass.php';
        $newmessage= new ClientMessage();
        $newmessage->countoldMessage();
        ?>
                </span></a>

            <?php
            } ?>
        </nav>
        <div id="logout">
            <a href="logout.php"><button class="btn"><i class="far fa-bell"></i>logout</button></a>
            <i class="far fa-user"></i>
        </div>

    </header>

    <main style="position:relative;margin-top:100px;">
        <div class="container">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-9 mb-4">
                    <!--Section: Content-->
                    <section>
                        <h6 style="font-size:15px;">
                            vous avez <?php
        $newmessage->countoldMessage();
        ?> messages repondus <?php $newmessage->getolmessageTodelele();?>
                        </h6>
                        <br>
                        <div id="moveit">
                            <!-- Post -->
                            <?php
        $newmessage= new ClientMessage();
        $newmessage->respondedMessage();
        ?>
                            <!-- fin post -->
                        </div>
                    </section>
                    <!--Section: Content-->
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 mb-4">

                    <section>
                        <!--Section: left item-->
                        <?php
                          require '../function/itemClass.php';
                           $item= new ItemProduct();
                            $item->leftFetchproduct();
                          ?>
                        <!--Section: left item-->
                    </section>

                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->

            <!-- Pagination -->
            <nav class="my-4">
                <ul class="pagination pagination-circle justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </main>
    <?php
     require 'footer.php';
    ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
    </script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- ajax and jquery -->
    <script>
    $(document).ready(function() {

        //ici on efface un old message ou un message deja repondu
        $(document).on('click', '#deleteoldmessage', function deleteoldmessage() {
            event.preventDefault();
            let $this = $(this).val();
            let idmessage = $(this).val();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/deleteoldmessage.php",
                data: {
                    idmessage: idmessage,
                    deleteoldmessage: 1
                },
                success: function(response) {
                    $('#oldmessage' + idmessage).html("");
                }
            });
        })
        //ici on efface tout les messages deja lu du cout:
        $(document).on('click', '#delallmessage', function delallmessage() {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "../ajaxPhp/deleteAllmessage.php",
                data: {
                    effacertout: 1
                },
                success: function(response) {
                    $('#moveit').html("");
                }
            });
        })
    });
    </script>
</body>

</html>