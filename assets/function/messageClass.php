<?php
class ClientMessage{
    
//cette fonction  va compter les messages pour l'admin::
public function countmessageRow(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM message where status='non_lu'";
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

//on va selectionner tout les messages non lu ou non repondu:
public function readMessage(){

    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
   try{
       //Récupérer les utilisateurs 
       $pdo = new PDO($dsn, $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $query = "SELECT * FROM message where status='non_lu'";
       $stmt = $pdo->query($query);
       $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
       //Afficher les utilisateurs
       foreach($users as $rows){
       ?>
<div class="row" id="hiderowmessage<?php echo $rows['idmessage']?>">
    <div class="col-md-2 mb-4">
        <div class="bg-image hover-overlay shadow-1-strong rounded">
            <img src="../image/holder.webp" class="img-fluid" />
            <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </a>
        </div>
    </div>

    <div class="col-md-10 mb-4">
        <div class="d-flex">
            <h5 style="padding:3px 5px;">name:<?php echo $rows['name']?></h5>&nbsp;&nbsp;&nbsp;,
            <h5 style="background-color:#d94350;padding:3px 5px;color:white;border-radius:5px;">mail:
                <?php echo $rows['mail']?></h5>,
            &nbsp;&nbsp;&nbsp;
            <h5 style="background-color:black;padding:3px 5px;color:white;border-radius:5px;">
                number:<?php echo $rows['numero']?></h5>
        </div>
        <p>
            "<?php echo $rows['message']?>"
        </p>
        <?php
           $query = "SELECT * FROM item where idItem =".$rows['item']." ";
           $stmt = $pdo->query($query);
           $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
           //Afficher les utilisateurs
           foreach($items as $rowofitem){
            ?>
        <div style="display:flex">
            <img src="<?php echo $rowofitem['image']?>" style="height: 200px;width:200px;object-fit:contain;" alt="">
            <div style="padding:10px 20px;justify-content:center;align-items:center">
                <h2>marque: <?php echo $rowofitem['voiture']?></h2>
                <h2>prix: <?php echo $rowofitem['prix']?> USD</h2>
                <h2>kilometre: <?php echo $rowofitem['kilometre']?> km</h2>
                <h2>Année: <?php echo $rowofitem['annee']?></h2>
            </div>
        </div>

        <?php
           }
        ?>

        <p style="background-color:#d94350;padding:3px 5px;color:white;border-radius:5px;font-size:12px;">
            NB: utilisez son mail ou numero de telephone pour repondre a ce client et
            apres cliquez en dessus sur repondu</p>

        <button class="btn btn-primary" id="reponsemessage" value="<?php echo $rows['idmessage']?>"
            style="padding:5px 5px;" data-mdb-ripple-init>REPONDU?</button>
    </div>
</div>

<?php
       }
   }
catch (PDOException $e){
       echo "error:".$e->getMessage();
   }
}

//afficher les messages repondu par l'admin:
public function respondedMessage(){

    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
   try{
       //Récupérer les utilisateurs 
       $pdo = new PDO($dsn, $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $query = "SELECT * FROM message where status='repondu'";
       $stmt = $pdo->query($query);
       $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
       //Afficher les utilisateurs
       foreach($users as $rows){
       ?>
<div class="row" id="oldmessage<?php echo $rows['idmessage']?>">
    <div class="col-md-2 mb-4">
        <div class="bg-image hover-overlay shadow-1-strong rounded">
            <img src="../image/holder.webp" class="img-fluid" />
            <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </a>
        </div>
    </div>

    <div class="col-md-10 mb-4">
        <div class="d-flex">
            <h5 style="padding:3px 5px;">name:<?php echo $rows['name']?></h5>&nbsp;&nbsp;&nbsp;,
            <h5 style="background-color:#d94350;padding:3px 5px;color:white;border-radius:5px;">mail:
                <?php echo $rows['mail']?></h5>,
            &nbsp;&nbsp;&nbsp;
            <h5 style="background-color:black;padding:3px 5px;color:white;border-radius:5px;">
                number:<?php echo $rows['numero']?></h5>
        </div>
        <p>
            "<?php echo $rows['message']?>"
        </p>
        <?php
           $query = "SELECT * FROM item where idItem =".$rows['item']." ";
           $stmt = $pdo->query($query);
           $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
           //Afficher les utilisateurs
           foreach($items as $rowofitem){
            ?>
        <div style="display:flex">
            <img src="<?php echo $rowofitem['image']?>" style="height: 200px;width:200px;object-fit:contain;" alt="">
            <div style="padding:10px 20px;justify-content:center;align-items:center">
                <h2>marque: <?php echo $rowofitem['voiture']?></h2>
                <h2>prix: <?php echo $rowofitem['prix']?> USD</h2>
                <h2>kilometre: <?php echo $rowofitem['kilometre']?> km</h2>
                <h2>Année: <?php echo $rowofitem['annee']?></h2>
            </div>
        </div>

        <?php
           }
        ?>
        <p style="background-color:#d94350;padding:3px 5px;color:white;border-radius:5px;font-size:12px;">
            NB: utilisez son mail ou numero de telephone pour repondre a ce client et
            apres cliquez en dessus sur repondu</p>

        <button class="btn btn-primary" id="deleteoldmessage" value="<?php echo $rows['idmessage']?>"
            style="padding:5px 5px;" data-mdb-ripple-init>effacer</button>
    </div>
</div>

<?php
       }
   }
catch (PDOException $e){
       echo "error:".$e->getMessage();
   }
}

//compter les messages deja repondu par l'admin:
public function countoldMessage(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM message where status='repondu'";
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

//ici nous allons selectioné tout le messages lu dans la base de donné 
//pour tout supprimer une seule fois avec avec un seul click
public function getolmessageTodelele(){

    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
   try{
       //Récupérer les utilisateurs 
       $pdo = new PDO($dsn, $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $query = "SELECT * FROM message where status='repondu'";
       $stmt = $pdo->query($query);
       $count = $stmt->fetchColumn();
   
       //Afficher les utilisateurs
      if($count >0){
        ?>
<button style="background-color:black;padding:5px 5px;color:white;border-radius:5px;" id="delallmessage">delete all
    messages</button>
<?php
      }else{
        ?>
<button style="background-color:black;padding:5px 5px;color:white;border-radius:5px;" disabled>delete all
    messages</button>
<?php
      }
   }
catch (PDOException $e){
       echo "error:".$e->getMessage();
   }
}
}