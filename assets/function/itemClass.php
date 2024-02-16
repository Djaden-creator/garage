<?php
 class ItemProduct{

    //cette function va enregistrer les produits dans la base de donnée:
   public function itemPr(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
    try{

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['itemfill'])) {
            $session=$_SESSION['email'];
            $name = $_POST['name'];
            $kilometre = $_POST['kilometre'];
            $annee = $_POST['annee'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];
            
             
            if (empty($name)||empty($kilometre)||empty($annee)||empty($prix)||empty($description))
            {
               ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">oupps remplissez tout le champs !!!</h5>
</div>
<?php
            }
            else{
                $picture=$_FILES['picture'];

                $filename=$_FILES['picture']['name'];
                $file_size=$_FILES['picture']['size'];
                $file_error=$_FILES['picture']['error'];
                $tmp=$_FILES['picture']['tmp_name'];
                $file_type=$_FILES['picture']['type'];
                
                $fileext=explode('.',$filename);
                $filecheck=strtolower(end($fileext));
               
                $destinationfile='../postes/'.$session.'/images/';
                
                $target_file=$destinationfile.basename($_FILES['picture']['name']);
                 $extensions=array("jpeg","jpg","png","webp","ARW");
                 $max_file_size = 200000000;
                 if (in_array($filecheck,$extensions)==false) {
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        vous venez de telecharger un produit sans photo,veuillez demandez
        a l'admin de mettre une photo a votre place
    </h5>
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
                          $full_url=$path.'/'.'postes/'.$session.'/images/'.$filename;
             
                           $sql="INSERT INTO `item`(`voiture`, `kilometre`,
                            `annee`, `prix`, `image`, `description`,
                            `emailUser`, `entrer`)
                           VALUES (:name, :kilometre, :annee, :prix, :full_url, :description, :session,now())";
                           
                           $statement=$pdo->prepare($sql);
                           $statement->bindParam(':name',$name);
                           $statement->bindParam(':kilometre',$kilometre);
                           $statement->bindParam(':annee',$annee);
                           $statement->bindParam(':prix',$prix);
                           $statement->bindParam(':full_url',$full_url);
                           $statement->bindParam(':description',$description);
                           $statement->bindParam(':session',$session);
                          if($statement->execute()){
                            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">l'enregistrement reussi avec succée</h5>
</div>
<?php
                          }
                           else{
                            ?>
<div style="background-color:#d94350;display:
                            flex;justify-content:center; align-items:center;
                                border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">telechargement de photo a échouée</h5>
</div>
<?php
                           
                     }
                 
            }
             }
    }catch(PDOException $e){
        echo"error";
    }
     
   }

   //afficher tout les item ou produit pour le visiteur du site:

   public function visitorProduct(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item  ORDER BY 	idItem DESC";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($items){
            foreach($items as $rows){
                ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
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
        <a href="assets/templates/detail.php?id=<?php  echo $rows['idItem']?>" class="btn">voir le details</a>
    </div>
</div>

<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        rien n'est encore poster pour les visiteurs
    </h5>
</div>
<?php
        }
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard"
    </h5>
</div>
<?php
      
    }
   }

   //nous allons implementer les articles poster par un employé ou admin c'est
   //lui seul qui le verra pour le moment:
   public function retrieveItem(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs 
        $session=$_SESSION['email'];

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item where  emailUser='$session'  ORDER BY 	idItem DESC";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($items){
            foreach($items as $rows){
                ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
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
        <div class="price"><?php  echo $rows['prix']?></div>
        <a href="../templates/detail.php?id=<?php  echo $rows['idItem']?>" class="btn">voir le details</a>
    </div>
</div>

<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        rien n'est encore poster pour le moment
    </h5>
</div>
<?php
        }
 
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard"
    </h5>
</div>
<?php
    }
   }
//nous allons retrieve tout le voitures pour l'administrateur dans la page detail
public function retrieveItemforadmin(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les voitures 

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item  ORDER BY 	idItem DESC";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($items){
            foreach($items as $rows){
                ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
    <div class="content">
        <h3><?php  echo $rows['voiture']?></h3>
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
        <div class="price"><?php  echo $rows['prix']?> USD</div>
        <a href="../templates/detail.php?id=<?php  echo $rows['idItem']?>" class="btn">voir le details</a>
    </div>
</div>

<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        rien n'est encore poster pour le moment
    </h5>
</div>
<?php
        }
 
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard"
    </h5>
</div>
<?php
    }
   }


   //cette fonction va afficher tout les article pour l'admin:
   public function fetchAllproduct(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item  ORDER BY 	idItem DESC";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        foreach($items as $rows){
        ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
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
        <div class="stars">
            <form action="" method="post">
                <input type="hidden" name="itemid" value="<?php echo $rows['idItem']?>">
                <button type="submit" class="btn" name="deleteitem"
                    value="<?php echo $rows['idItem'] ?>">delete</button>
                <a href="modifierProduit.php?id=<?php  echo $rows['idItem'];?>" class="btn">modifier</a>
            </form>
        </div>
    </div>
</div>

<?php
        }
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard"
    </h5>
</div>
<?php
      
    }
   }

   //delete item product by user from the database:
   public function deleteProduct(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         if(isset($_POST['deleteitem'])){
           $itemid=$_POST['itemid'];

           $sql="DELETE from item where idItem=:itemid";
           $statement=$pdo->prepare($sql);
           $statement->bindParam(':itemid',$itemid);
           
          if($statement->execute()){
            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">vous venez de supprimer un produit dans la base de donnée</h5>
</div>
<?php
         }
         else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">oopps suppression echoué veuillez recommencer</h5>
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
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard
    </h5>
</div>
<?php
    }
   }

   //count rows of item product function
   public function countproductRow(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM item";
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

   //count rows of item product function
   public function countproductUser(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $session=$_SESSION['email'];
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM item where emailUser='$session'";
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

// cette function va modifier le produits dans la base de donnée:   
    public function itemUpdate(){
        $dsn = 'mysql:host=localhost;dbname=garage';
        $username = 'root';
        $password = getenv('');
        try{
    
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_POST['updateItems'])) {
                $getmail = $_POST['getmail'];
                $getid = $_POST['getid'];
                $voiture = $_POST['voiture'];
                $kilometre = $_POST['kilometre'];
                $annee = $_POST['annee'];
                $prix = $_POST['prix'];
                $description = $_POST['description'];
                
                     if (empty($voiture)||empty($kilometre)||empty($annee)||empty($prix)||empty($description)) {
                        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs doivent etre remplis
    </h5>
</div>
<?php
                                }
                                else{
                                    $sql="UPDATE item SET voiture= :voiture, kilometre=:kilometre,
                                    annee= :annee,prix= :prix,description= :description,entrer= NOW() where idItem= :getid";
                                   
                                   $statement=$pdo->prepare($sql);
                                   $statement->bindParam(':voiture',$voiture);
                                   $statement->bindParam(':kilometre',$kilometre);
                                   $statement->bindParam(':annee',$annee);
                                   $statement->bindParam(':prix',$prix);
                                   $statement->bindParam(':description',$description);
                                   $statement->bindParam(':getid',$getid);
                                  if($statement->execute()){
                                    ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">modification reussi avec succée</h5>
</div>
<?php
                                  }
                                   else{
                                    ?>
<div style="background-color:#d94350;display:
                                    flex;justify-content:center; align-items:center;
                                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">modification a échouée</h5>
</div>
<?php
                                   
                             }
                                }
                 
                              
                     
                }
        }
        catch(PDOException $e){
            echo"error:".$e->getMessage();
        }
         
       }

// fetch product in the left side in fetchmessagepage.php
public function leftFetchproduct(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item  ORDER BY 	idItem DESC limit 8";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($items){
            foreach($items as $rows){
                ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
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
        <div class="stars">
            <form action="" method="post">
                <input type="hidden" name="itemid" value="<?php echo $rows['idItem']?>">
                <a href="modifierProduit.php?id=<?php  echo $rows['idItem'];?>" class="btn">modifier</a>
            </form>
        </div>
    </div>
</div>
<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        aucune voiture enregistrée
    </h5>
</div>
<?php
        }
       
    }
    catch (PDOException $e){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouff une erreur est survenue a la base de donnée veuillez passer plus tard"
    </h5>
</div>
<?php
      
    }
   }
}
 
 
 
 