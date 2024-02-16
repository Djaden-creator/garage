<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['updatep'])){
        $getid=$_POST['getid'];
        $passwupd=$_POST['passwupd'];
        if(empty($getid)|| empty($passwupd)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        le champs ne doit pas etre vide
    </h5>
</div>
<?php
        }else{
             $hashpass=md5($passwupd);
             $sql="UPDATE `users` SET `passw`=:hashpass where idUser= :getid";
            
             $statement=$pdo->prepare($sql);
             $statement->bindParam(':hashpass',$hashpass);
             $statement->bindParam(':getid',$getid);
             $statement->execute();
             if ($statement){
                ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        le mot de passe a été modifié
    </h5>
</div>
<?php
             }

                
        }
    }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}