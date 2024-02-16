<?php
    $dsn ='mysql:host=localhost;dbname=garage';
    $username ='root';
    $password =getenv('');
       
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['reviewsend'])){
            $namereviewer=$_POST['namereviewer'];
            $pets=$_POST['pets'];
            $commentreview=$_POST['commentreview'];
            if(empty( $namereviewer)||empty($pets)||empty($commentreview)){
                ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        tout le champs sont obligatoire
    </h5>
</div>
<?php
            }else{
                $sql="INSERT INTO `temoignages`(`name`, `note`, `description`, `status`, `entry`)
                 VALUES (:namereviewer,:pets,:commentreview,'non',NOW())";
                 $statement=$pdo->prepare($sql);
                 $statement->bindParam(':namereviewer',$namereviewer);
                 $statement->bindParam(':pets',$pets);
                 $statement->bindParam(':commentreview',$commentreview);
                 $statement->execute();
                 if($statement){
                    ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        votre temoignage a été enregistré
    </h5>
</div>
<?php
                 }else{
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                                    border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        votre temoignage n'a pas été enregistré
    </h5>
</div>
<?php
                 }
         }
        }
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