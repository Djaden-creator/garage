<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');

try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['item'])){
        $iditem=$_POST['iditem'];
        if(empty($iditem)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        remplissez tout le champs
    </h5>
</div>
<?php
        }else{
            
            $query = "SELECT * FROM item where idItem='$iditem'";
            $stmt = $pdo->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            //Afficher les utilisateurs
            foreach($users as $rows){
             
                ?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="getid" value="<?php echo $iditem?>" class="box">
    <input type="hidden" name="email" value="<?php echo $rows['emailUser']?>" class="box">
    <input type="file" name="photo">
    <button type="submit" name="itemphoto" class="btn">valider</button>
    <button class="btn" id="cloit" value="<?php echo $iditem?>">fermer</button>
</form>
<?php
             }
            }
        }
    }
    catch(PDOException $e){
    echo"error:".$e->getMessage();
}