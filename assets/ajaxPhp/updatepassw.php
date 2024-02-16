<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['updatepass'])){
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
<form action="" method="post">
    <input type="hidden" name="getid" value="<?php echo $iduser?>" class="box">

    <input type="password" name="passwupd" class="box" value="<?php echo $rows['passw']?>">
    <button type="submit" name="updatep" class="btn">valider</button>
    <button class="btn" id="closeform" value="<?php echo $iduser?>">fermer</button>

</form>
<?php
             }
            }
        }
    }
    catch(PDOException $e){
    echo"error:".$e->getMessage();
}