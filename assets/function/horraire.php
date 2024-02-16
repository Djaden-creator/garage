<?php
//cree un horraire pour le garage:
class HorraireGarage{
public function horraireTime(){

$dsn = 'mysql:host=localhost;dbname=garage';
$username = 'root';
$password = getenv('');
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de connexion
    if(isset($_POST['horraire'])) {
    $jour = $_POST['jour'];
    $commence = $_POST['commence'];
    $fin = $_POST['fin'];
    $mididebut = $_POST['mididebut'];
    $midifin = $_POST['midifin'];
    $description = $_POST['description'];


    if(empty($jour) || empty($commence)|| empty($fin)|| empty($mididebut)|| empty($midifin)|| empty($description)){
        ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs sont obligatoires
    </h5>
</div>
<?php
}else{
    $sql="INSERT INTO `horraire`(`jour`, `heureDebut`, `heureFin`,`mididebut`, `midifin`,`description`)
   VALUES (:jour,:commence,:fin,:mididebut, :midifin, :description)";

$statement=$pdo->prepare($sql);
$statement->bindParam(':jour',$jour);
$statement->bindParam(':commence',$commence);
$statement->bindParam(':fin',$fin);
$statement->bindParam(':mididebut',$mididebut);
$statement->bindParam(':midifin',$midifin);
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
<div style="background-color:#d94350;display:flex;justify-content:center;
      align-items:center;
           border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">ooopps connection a la base de donnée echoué</h5>
</div>
<?php
 }
}

//recuperer les horraires dans la base de donnée pour l'admin:

public function getChedule(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer le chedule  
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM horraire";
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        //Afficher les chedule
        if($users){
            foreach($users as $rows){
                if($rows['jour']=="dimanche"){
                    ?>
<a href="#"> <i class="fas fa-map-marker-alt"></i><?php echo $rows['jour']?> :
    <?php echo $rows['description'];?>
</a>
<?php
                }elseif($rows['jour']=="samedi"){
                    ?>
<a href="#"> <i class="fas fa-map-marker-alt"></i><?php echo $rows['jour']?> :
    [<?php echo $rows['heureDebut']?> - <?php echo $rows['heureFin']?>]
</a>
<?php
                } else{
                    ?>
<a href="#"> <i class="fas fa-map-marker-alt"></i><?php echo $rows['jour']?> :
    [<?php echo $rows['heureDebut']?> - <?php echo $rows['heureFin']?>],
    [<?php echo $rows['mididebut']?> - <?php echo $rows['midifin']?>]
</a>
<?php
                }
            
            }
        }else{
            ?>
<h2>fermé pour le moment</h2>
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

//get all horraire for the admin modification:
    public function getAdminchedule(){
        $dsn = 'mysql:host=localhost;dbname=garage';
        $username = 'root';
         $password = getenv('');
        try{
            //Récupérer le chedule  
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM horraire";
            $stmt = $pdo->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            //Afficher les chedule
            if($users){
                foreach($users as $rows){
                    ?>
<div class="box">
    <i style="font-size:25px;" class="fas fa-car"></i>
    <h3 style="font-size:18px;"><?php echo $rows['jour'] ?></h3>
    <p style="font-size:15px;"><?php echo $rows['description'] ?></p>
    <a href="editchedule.php?id=<?php echo $rows['horraireid'] ?>" class="btn">modifier</a>
</div>
<?php
                
                }
            }else{
                ?>
<div class="box">
    <i style="font-size:25px;" class="fas fa-car"></i>
    <p style="font-size:15px;">pas d'horaire disponible actuellement</p>
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

//modifier horraire;update the chedule 
public function updateChedule(){
    $dsn = 'mysql:host=localhost;dbname=garage';
    $username = 'root';
     $password = getenv('');
    try{
        //Récupérer le chedule  
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['updatehorraire'])){
    $getid=$_POST['getid'];
    $jour= $_POST['jour'];
    $commence= $_POST['commence'];
    $fin= $_POST['fin'];
    $mididebut= $_POST['mididebut'];
    $midifin= $_POST['midifin'];
    $description= $_POST['description'];

    $sql="UPDATE horraire SET jour= :jour,heureDebut= :commence,heureFin= :fin,mididebut= :mididebut,
    midifin= :midifin,description= :description WHERE horraireid= :getid";

    $statement=$pdo->prepare($sql);
    $statement->bindparam(':jour',$jour);
    $statement->bindparam(':commence',$commence);
    $statement->bindparam(':fin',$fin);
    $statement->bindparam(':mididebut',$mididebut);
    $statement->bindparam(':midifin',$midifin);
    $statement->bindparam(':description',$description);
    $statement->bindparam(':getid',$getid);
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
    <h5 style="color: #f2f2f2;font-size:18px">modification echoué </h5>
</div>
<?php
}
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