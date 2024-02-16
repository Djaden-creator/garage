<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['updatemessageStatus'])){
        $idmessage=$_POST['idmessage'];
             $sql="UPDATE `message` SET `status`='repondu' where idmessage= :idmessage";
            
             $statement=$pdo->prepare($sql);
             $statement->bindParam(':idmessage',$idmessage);
             $statement->execute();
        }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}