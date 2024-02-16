<?php
class ClientTemoignage{
    public function temClient(){
        $dsn ='mysql:host=localhost;dbname=garage';
        $username ='root';
        $password =getenv('');
           
        try{
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if(isset($_POST['sendtem'])){
                $name=$_POST['name'];
                $pets=$_POST['pets'];
                $comment=$_POST['comment'];

                if(empty($name)||empty($pets)||empty($comment)){
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs sont obligatoire
    </h5>
</div>
<?php
                }else{
                    $sql="INSERT INTO `temoignages`(`name`, `note`, `description`, `status`, `entry`)
                     VALUES (:name,:pets,:comment,'non',NOW())";
                     $statement=$pdo->prepare($sql);
                     $statement->bindParam(':name',$name);
                     $statement->bindParam(':pets',$pets);
                     $statement->bindParam(':comment',$comment);
                     $statement->execute();
                     if($statement){
                        ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        votre temoignage a été enregistré
    </h5>
</div>
<?php
                     }else{
                        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        votre temoignage n'a pas été enregistré
    </h5>
</div>
<?php
                     }
             }
            }
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
//afficher tout le temoignages pour le user with the ID=2:
public function temoignageClient(){

    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
   try{
       //Récupérer les utilisateurs 
       $pdo = new PDO($dsn, $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $query = "SELECT * FROM temoignages ";
       $stmt = $pdo->query($query);
       $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
       //Afficher les utilisateurs
       if($users){
        foreach($users as $rows){
            ?>
<div class="box">
    <img src="../image/holder.webp" alt="" style="height:193px;width:190px;object-fit:contain;">
    <div class="content">
        <h6 id="time<?php echo $rows['idtemoignage'];?>"></h6>
        <?php
             if($rows['status']=="non"){
              ?>
        <div id="hidebtn<?php echo $rows['idtemoignage'] ?>">
            <button class="btn" id="nonapprouver" value="<?php echo $rows['idtemoignage'] ?>">non approuvé</button>
        </div>

        <?php
             }else{
                 ?>
        <div id="hidebtntwo<?php echo $rows['idtemoignage'] ?>">
            <button class="btn" id="approuver" value="<?php echo $rows['idtemoignage'] ?>">approuvé</button>
        </div>

        <?php
             }
             ?>

        <p>
            <?php echo $rows['description'] ?>
        </p>
        <h3><?php echo $rows['name'] ?></h3>
        <?php
              if($rows['note']==1){
                ?>
        <div class=" stars">
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
              }
              elseif($rows['note']==2){
                 ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
               }
               elseif($rows['note']==3){
                 ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
               }
               elseif($rows['note']==4){
                 ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
               }
               elseif($rows['note']==5){
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
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
        </div>
        <?php
               }
             ?>
    </div>
</div>

<?php
            }
       }else{
        ?>
<div class="box">
    <div class="content">
        <h2>aucun temoignage enregistré</h2>
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
//implement all reviews in the index page foe the customer:
public function allreviews(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs 
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM temoignages where status='accepted' limit 8";
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($users){
            foreach($users as $rows){
                ?>
<div class="box">
    <img src="assets/image/holder.webp" alt="" style="height:193px;width:190px;object-fit:contain;">
    <div class="content">
        <p style="font-size:15px;">
            <?php echo $rows['description'] ?>
        </p>
        <h3><?php echo $rows['name'] ?></h3>
        <?php
                 if($rows['note']==1){
                   ?>
        <div class=" stars">
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                 }
                 elseif($rows['note']==2){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==3){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==4){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==5){
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
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
        </div>
        <?php
                  }
                ?>
    </div>
</div>
<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
            align-items:center;border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">0 temoignage enregistré pour le moment!!!</h5>
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

//implement all reviews in the detailservice page

public function reviews(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs 
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM temoignages where status='accepted' limit 4";
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($users){
            foreach($users as $rows){
                ?>
<div class="box">
    <img src="../image/holder.webp" alt="" style="height:193px;width:190px;object-fit:contain;">
    <div class="content">
        <p style="font-size:15px;">
            <?php echo $rows['description'] ?>
        </p>
        <h3><?php echo $rows['name'] ?></h3>
        <?php
                 if($rows['note']==1){
                   ?>
        <div class=" stars">
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                 }
                 elseif($rows['note']==2){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==3){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==4){
                    ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        <?php
                  }
                  elseif($rows['note']==5){
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
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
            <i class="fa-thin fa-star"></i>
        </div>
        <?php
                  }
                ?>
    </div>
</div>
<?php
                }
        }else{
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center;
            align-items:center;border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">0 temoignage enregistré pour le moment!!!</h5>
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
}