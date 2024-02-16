<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['desapprouv'])){
        $approuv=$_POST['approuv'];
        if(empty($approuv)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouppps il ya un probleme
    </h5>
</div>
<?php
        }else{
             $sql="UPDATE `temoignages` SET `status`='non' where idtemoignage= :approuv";
            
             $statement=$pdo->prepare($sql);
             $statement->bindParam(':approuv',$approuv);
             $statement->execute();
             if($statement){
                ?>
<div id="hidebtn<?php echo $approuv ;?>">
    <button class="btn" id="nonapprouver" value="<?php echo $approuv;?>">non approuvé</button>
</div>
<?php
             }
                
        }
    }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}