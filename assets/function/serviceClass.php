<?php

class ServiceClass{
public function service(){

$dsn = 'mysql:host=localhost;dbname=garage';
$username = 'root';
$password = getenv('');
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de connexion
    if(isset($_POST['addservice'])) {

    $service = $_POST['service'];
    $description = $_POST['description'];

    if(empty($service) || empty($description)){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs sont obligatoires
    </h5>
</div>
<?php
}else{
   $sql="INSERT INTO `services`(`service`, `description`, `annee`) 
   VALUES (:service, :description,NOW())";

$statement=$pdo->prepare($sql);
$statement->bindParam(':service',$service);
$statement->bindParam(':description',$description);
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

//counter le nombre de mes services 
public function countserviceRow(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
    $password = getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) FROM services";
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

//recuperer tout le services de la base de donnée :
public function fetchAllservice(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        //Récupérer les utilisateurs
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM services";
        $stmt = $pdo->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les utilisateurs
        if($items){
            foreach($items as $rows){
                $string=strip_tags($rows['description']);
                if(strlen($string)>50):
                    $stringcut=substr($string,0,50);
                    $endpoint=strrpos($stringcut,' ');
                    $string=$endpoint?substr($stringcut,0,$endpoint):substr($stringcut,0);
                    $string.='...';
                endif;
                ?>
<div class="box">
    <i style="font-size: 30px;" class="fas fa-car"></i>
    <h3 style="font-size:25px;"><?php echo $rows['service'] ?></h3>
    <p style="font-size:16px;"><?php echo $string ?></p>
    <form action="" method="post">
        <input type="hidden" name="serviceid" value="<?php echo $rows['serviceid'] ?>">
        <button type="submit" name="deleteservice" class="btn">supprimer</button>
        <a href="modifierservice.php?id=<?php echo $rows['serviceid'] ?>" class="btn">modifier</a>
    </form>
</div>

<?php
            }
        }
        else{
            ?>
<div class="box">
    <i style="font-size: 30px;" class="fas fa-car"></i>
    <p style="font-size:16px;">aucun service disponible pour le moment</p>
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

   //delete service in the database:
   public function deleteService(){
    $dsn = 'mysql:host=localhost;dbname=garage';
     $username = 'root';
     $password = getenv('');
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         if(isset($_POST['deleteservice'])){
           $serviceid=$_POST['serviceid'];

           $sql="DELETE from services where serviceid= :serviceid";
           $statement=$pdo->prepare($sql);
           $statement->bindParam(':serviceid',$serviceid);
           
          if($statement->execute()){
            ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">vous venez de supprimer un service dans la base de donnée</h5>
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

//modification des services dans la base de donnée:
    public function updateService(){
        $dsn = 'mysql:host=localhost;dbname=garage';
        $username = 'root';
         $password = getenv('');
        try{
            //Récupérer les utilisateurs
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
               if(isset($_POST['updateservice'])){
               $getid=$_POST['getid'];
               $service=$_POST['service'];
               $description=$_POST['description'];

               $sql="UPDATE services SET service= :service,description= :description where serviceid= :getid";

                           $statement=$pdo->prepare($sql);
                           $statement->bindParam(':service',$service);
                           $statement->bindParam(':description',$description);
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
//afficher le service sur la page index pour le visiteurs:
    public function visitorService(){
        $dsn = 'mysql:host=localhost;dbname=garage';
        $username = 'root';
         $password = getenv('');
        try{
            //Récupérer le services  
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM services";
            $stmt = $pdo->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            //Afficher les services
            if($users){
                foreach($users as $rows){
                    $string=strip_tags($rows['description']);
                    if(strlen($string)>50):
                        $stringcut=substr($string,0,50);
                        $endpoint=strrpos($stringcut,' ');
                        $string=$endpoint?substr($stringcut,0,$endpoint):substr($stringcut,0);
                        $string.='...';
                    endif;
                   
        ?>
<div class="box">
    <i class="fas fa-car"></i>
    <h3><?php echo $rows['service'] ?></h3>
    <p><?php echo $string ?></p>
    <a href="assets/templates/detailService.php?id=<?php echo $rows['serviceid'] ?>" class="btn"> read more</a>
</div>

<?php
                    }
            }
            else{
                    ?>
<div class="box">
    <i class="fas fa-car"></i>
    <h3>Aucun service disponible pour le moment</h3>
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