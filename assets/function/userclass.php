<?php
session_start();
class UserAuth{
public function login(){

$dsn = 'mysql:host=localhost;dbname=garage';
$username = 'root';
$password = getenv('');
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de connexion
    if(isset($_POST['signup'])) {
    $emailForm = $_POST['email'];
    $passwordForm = $_POST['password'];

    if(empty($emailForm) || empty($passwordForm)){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs sont obligatoire
    </h5>
</div>
<?php
    }else
        {
        $password_hash = md5($passwordForm);
         //Récupérer les utilisateurs
        $query = "SELECT * FROM users WHERE email = :emailForm and passw= :password_hash";
       
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':emailForm', $emailForm);
        $stmt->bindParam(':password_hash',$password_hash);
        $stmt->execute(

            array(
                'emailForm'=>$emailForm,
                'password_hash'=>$password_hash,
            )
        );
         //Est-ce que l’utilisateur (mail) existe ?
        $count=$stmt->rowCount();
        if($count==1){
            foreach($stmt as $rows){
                $_SESSION['idUser']=$rows['idUser'];
                $_SESSION['username']=$rows['username'];
                $_SESSION['email']=$emailForm;
            header('location:profil.php');
        }
    }
        else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        Utilisateur introuvable, êtes-vous sûr de votre mail
    </h5>
</div>
<?php
        }
        }
}
}
catch (PDOException $e){
    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        oops impossible de se connecter a la base de donnée
    </h5>
</div>
<?php
   
}
}

//enregistrement des utilisateurs
public function signUPuser(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');

    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['userfill'])){
            $username = $_POST['username'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $pays = $_POST['pays'];
            $adress = $_POST['adress'];
            $password = $_POST['password'];
            if(empty($username)||empty($name)||empty($email)||empty($numero)||empty($pays)||empty($adress)||empty($password)){
                ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champ sont obligatoire
    </h5>
</div>
<?php
            }
            elseif(strlen($password) < 8){
                ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        le mot de pass doit avoir aumoin 8 characteurs
    </h5>
</div>
<?php
            }else{
                $password_hash = md5($password);
                  $sql_u = "SELECT * FROM  users WHERE username=:username";
                  $sql_e = "SELECT * FROM  users WHERE email=:email";
                  $stmt = $pdo->prepare($sql_u);
                  $stmt->bindParam(':username', $username);
                  $stmt->execute();

                  $state=$pdo->prepare($sql_e);
                  $state->bindParam(':email',$email);
                  $state->execute();
                  //Est-ce que l’utilisateur (mail) existe ?
                 $count=$stmt->rowCount();
                 $counttwo=$state->rowCount();
                 if($count==1){
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        desolé cet username existe deja
    </h5>
</div>
<?php
                 }
                elseif($counttwo==1){
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        cet adress email est pris trouvez un autre
    </h5>
</div>
<?php
                }else{
                    $image=$_FILES['image'];
                $filename=$_FILES['image']['name'];
                $file_size=$_FILES['image']['size'];
                $file_error=$_FILES['image']['error'];
                $tmp=$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                
                $fileext=explode('.',$filename);
                $filecheck=strtolower(end($fileext));
               
                $destinationfile='../profilpicture/'.$username.'/images/';
                $target_file=$destinationfile.basename($_FILES['image']['name']);
                 $extensions=array("jpeg","jpg","png","webp","ARW");
                 $max_file_size = 200000000;
                 if (in_array($filecheck,$extensions)==false) {
                    ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">votre photo est a jour</h5>
</div>
<?php
                            }
                            if (!file_exists ($destinationfile)) {
                             mkdir($destinationfile,0777,true);
                             }
                           move_uploaded_file($tmp,$target_file);
                          $url=$_SERVER['HTTP_REFERER'];
                          $seg=explode('/',$url);
                          $path=$seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3].'/'.$seg[4];
                          $full_url=$path.'/'.'profilpicture/'.$username.'/images/'.$filename;
             
                         $sql="INSERT INTO `users`(`username`, `name`, `email`, `numero`,`pays`,`adress`, `passw`, `image`, `embaucher`)
                          VALUES (:username, :name, :email,:numero,:pays,:adress, :password_hash, :full_url, NOW())";
                         
                           $statement=$pdo->prepare($sql);
                           $statement->bindParam(':username',$username);
                           $statement->bindParam(':name',$name);
                           $statement->bindParam(':email',$email);
                           $statement->bindParam(':numero',$numero);
                           $statement->bindParam(':pays',$pays);
                           $statement->bindParam(':adress',$adress);
                           $statement->bindParam(':password_hash',$password_hash);
                           $statement->bindParam(':full_url',$full_url);
                          if($statement->execute()){
                            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                  border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">l'enregistrement reussi avec succée</h5>
</div>
<?php
                          }else{
                          ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
                             align-items:center;
                                  border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">l'enregistrement a echoué</h5>
</div>
<?php
                          }
                        }
                 
            }
         }
            
    }  
       catch(PDOException $e){
             echo"echec" .$e->getMessage();
    }
}

//recuperation de donnée user:
public function userDetail(){

     $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs 
        $emailForm=$_SESSION['email'];
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users where  email='$emailForm' ";
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        foreach($users as $rows){
        ?>
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
            <button class="btn" id="publieritem">publier</button>
            <button class="btn" id="publieruser">new employe</button>
            <a href="horraire.php"><button class="btn">nouveau horraire</button></a>
            <a href="modifierHoraire.php"><button class="btn">gerer mes horraires</button></a>
        </div>
        <div class="publicitem">
            <a href="gererarticle.php"><button class="btn" id="publieritem">gerer article</button></a>
            <a href="gereremploy.php"><button class="btn">gerer employées</button></a>
            <a href="ajouterservice.php"><button class="btn">nouveau service</button></a>
            <a href="gererservice.php"><button class="btn">gerer mes services</button></a>
        </div>
        <?php
        }elseif($rows['idUser']==2){
           ?>
        <div class="publicitem">
            <button class="btn" id="publieritem">publier</button>
            <a href="temoignage.php" class="btn">temoignages</a>
        </div>
        <?php
        }else{
            ?>
        <div class="publicitem">
            <button class="btn" id="publieritem">publier</button>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
        }
    }
catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
align-items:center;border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">Erreur de connexion à la base de données</h5>
</div>
<?php
    }
}

//recuperation de tout les utilisateur:
public function allUsers(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs 
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users  ORDER BY idUser DESC";
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        foreach($users as $rows){
        ?>
<div class="box">
    <img src="<?php echo $rows['image'] ?>" alt="" style="height:193px;width:190px;object-fit:contain;">
    <div class="content">
        <h3><?php echo $rows['name'] ?></h3>
        <h3><?php echo $rows['email'] ?></h3>
        <?php
          if($rows['idUser']==1){
            ?>
        <h3 style="padding:10px;background-color:#d94350;color:white">admin</h3>
        <?php
          }
        ?>

        <div class="stars">
            <form action="" method="post">
                <input type="hidden" name="myid" value="<?php echo $rows['idUser']?>">

                <?php
                     if($rows['idUser']==1){
                    ?>
                <a href="modifieruser.php?id=<?php  echo $rows['idUser'];?>" class="btn">modifier</a>
                <?php
                    }else{
                        ?>
                <button type="submit" class="btn" name="deleteuser"
                    value="<?php echo $rows['idUser'] ?>">delete</button>
                <a href="modifieruser.php?id=<?php  echo $rows['idUser'];?>" class="btn">modifier</a>
                <?php
                    }
                    ?>

            </form>
        </div>
    </div>
</div>

<?php
        }
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
align-items:center;border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">Erreur de connexion à la base de données</h5>
</div>
<?php
    }
}

//modification des details des employé:
    public function updateUser(){
        $dsn = 'mysql:host=localhost;dbname=garage';
        $username = 'root';
         $password = getenv('');
        try{
            //Récupérer les utilisateurs
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
             if(isset($_POST['updateuser'])){
              
               $username=$_POST['username'];
               $name=$_POST['name'];
               $email=$_POST['email'];
               $numero=$_POST['numero'];
               $pays=$_POST['pays'];
               $adress=$_POST['adress'];
               $getid=$_POST['getid'];
             
                         $sql="UPDATE users SET username= :username,numero= :numero,pays= :pays,adress= :adress,name= :name,email= :email
                          where idUser= :getid";
                         
                           $statement=$pdo->prepare($sql);
                           $statement->bindParam(':username',$username);
                           $statement->bindParam(':name',$name);
                           $statement->bindParam(':email',$email);
                           $statement->bindParam(':numero',$numero);
                           $statement->bindParam(':pays',$pays);
                           $statement->bindParam(':adress',$adress);
                           $statement->bindParam(':getid',$getid);
                          if($statement->execute()){
                            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                  border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">modification reussi avec succée</h5>
</div>
<?php
                          }else{
                          ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
                             align-items:center;
                                  border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">oopps veuillez recommencer</h5>
</div>
<?php
                          }
                        }
                 
            }
        catch (PDOException $e){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        Erreur de connexion à la base de données
    </h5>
</div>
<?php
        }
    }
// admin delete user functionality
public function deleteUser(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         if(isset($_POST['deleteuser'])){
           $myid=$_POST['myid'];
           $sql="DELETE from users where idUser=:myid";
           $statement=$pdo->prepare($sql);
           $statement->bindParam(':myid',$myid);
           
          if($statement->execute()){
            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                  border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">vous venez d'effacer un employé dans votre base de donnée</h5>
</div>
<?php
         }
         else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        opps gone wrong
    </h5>
</div>
<?php
           
         }
        }
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        Erreur de connexion à la base de données
    </h5>
</div>
<?php
    }
}

//function of counting number of users in the database:
public function countuserRow(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM users";
        $res = $pdo->query($sql);
        $count = $res->fetchColumn();
        echo $count;
    }catch(PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff nous ne pouvons pas compter vos produit pour le moment
    </h5>
</div>
<?php
    }
   }

//sur la page d'accueil implementons le contact de l'etablissement
public function contactEtablissement(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
   try{
       //Récupérer le numero de l'admin 
       $pdo = new PDO($dsn, $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $query = "SELECT * FROM users where idUser=1";
       $stmt = $pdo->query($query);
       $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
       //Afficher les utilisateurs
       if($users){
        foreach($users as $rows){
            ?>
<a href="#"> <i class="fas fa-phone"></i> <?php echo $rows['numero'] ?> </a>
<a href="#"> <i class="fas fa-envelope"></i> <?php echo $rows['email'] ?> </a>
<a href="#"> <i class="fas fa-map-marker-alt"></i> <?php echo $rows['pays'] ?></a>
<a href="#"> <i class="fas fa-map-marker-alt"></i> <?php echo $rows['adress'] ?></a>
<?php
    
           }
       }else{
        ?>
<h2>contact indisponible</h2>
<?php
       }
       
}catch(PDOException $se){
    echo"ouppps aucune connection etablie";
}
}
}