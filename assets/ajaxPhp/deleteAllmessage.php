<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['effacertout'])){
             $sql="DELETE FROM `message` WHERE  status='repondu' ";
            
             $statement=$pdo->prepare($sql);
             $statement->execute();
        }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}