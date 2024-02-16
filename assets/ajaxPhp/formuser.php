<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['updatepicture'])){
        $iduser=$_POST['iduser'];
        if(empty($iduser)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        remplissez tout le champs
    </h5>
</div>
<?php
        }else{
            
            $query = "SELECT * FROM users where idUser='$iduser'";
            $stmt = $pdo->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            //Afficher les utilisateurs
            foreach($users as $rows){
             
                ?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="getid" value="<?php echo $iduser?>" class="box">
    <input type="hidden" name="username" value="<?php echo $rows['username']?>" class="box">
    <input type="file" name="photo">
    <button type="submit" name="updatephoto" class="btn">valider</button>
    <button class="btn" id="closebottom" value="<?php echo $iduser?>">fermer</button>

</form>
<?php
             }
            }
        }
    }
    catch(PDOException $e){
    echo"error:".$e->getMessage();
}