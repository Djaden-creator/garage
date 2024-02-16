<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username = 'root';
 $password = getenv('');
 try{
    
    $pdo = new PDO($dsn,$username,$password);

    if(isset($_POST["minkilometre"]) && isset($_POST["maxkilometre"])){
        $minkilometre=$_POST['minkilometre'];
        $maxkilometre=$_POST['maxkilometre'];
$sql="SELECT * FROM item  where kilometre BETWEEN  $minkilometre AND $maxkilometre  ORDER BY idItem DESC";
    $statement=$pdo->prepare($sql);
    
    $statement->execute();
    $result=$statement->fetchAll();
    $total_row=$statement->rowCount();
    if($total_row > 0){
        foreach($result as $rows){
            ?>
<div class="box">
    <img src="<?php  echo $rows['image']?>" alt="image" style="width:180px;height:300px;object-fit:contain;">
    <div class="content">
        <h3><?php  echo $rows['voiture']?></h3>
        <div class="price"><?php  echo $rows['kilometre']?> km</div>
        <div class="price"><?php  echo $rows['annee']?></div>
        <div class="price"><?php  echo $rows['prix']?> USD</div>
        <?php
        if($rows['prix'] <= 3000){
            ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <?php
        }elseif($rows['prix'] <= 15000){
            ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <?php
        }elseif($rows['prix'] < 25000){
            ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <?php
        }elseif($rows['prix'] <= 100000){
            ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <?php
        }
        elseif($rows['prix'] >= 100000){
            ?>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <?php
        }else{
            ?>
        <div class="stars">
            <i class="fas fa-star-half-alt"></i>
        </div>
        <?php
        }
        
        ?>
        <a href="assets/templates/detail.php?id=<?php  echo $rows['idItem']?>" class="btn">voir le details</a>
    </div>
</div>


<?php
                    }
                }else{
                    ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                            border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        nous avons pas des voitures a ce kilometre
    </h5>
</div>
<?php
                }
 }
    
}catch(PDOException $e) {
    file_put_contents('dblogs.log', $e->getMessage().PHP_EOL, FILE_APPEND);
  echo "oups impossible de nous connecter";
}

    