<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['direct'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $numero=$_POST['numero'];
        $message=$_POST['message'];
        $item=$_POST['item'];
        if(empty($name)||empty($email)||empty($numero)||empty($message)||empty($item)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        remplissez tout le champs
    </h5>
</div>
<?php
        }else{
             $sql="INSERT INTO `message`(`name`, `mail`, `numero`, `message`, `entry`, `status`, `item`)
             VALUES (:name,:email,:numero,:message,NOW(),'non_lu',:item)";
            
             $statement=$pdo->prepare($sql);
             $statement->bindParam(':name',$name);
             $statement->bindParam(':email',$email);
             $statement->bindParam(':numero',$numero);
             $statement->bindParam(':message',$message);
             $statement->bindParam(':item',$item);
             $statement->execute();
             if($statement){
                ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        votre message a été envoyé avec succée
    </h5>
</div>
<?php
             }
                
        }
    }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}