<?php
$dsn ='mysql:host=localhost;dbname=garage';
$username ='root';
$password =getenv('');
   
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST['itemphoto'])){
        
        $getid=$_POST['getid'];
        $email=$_POST['email'];
        if(empty($getid)||empty($email)){
            ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                        border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">
        ouppps il ya un probleme
    </h5>
</div>
<?php
        }else{
                $photo=$_FILES['photo'];
                $filename=$_FILES['photo']['name'];
                $file_size=$_FILES['photo']['size'];
                $file_error=$_FILES['photo']['error'];
                $tmp=$_FILES['photo']['tmp_name'];
                $file_type=$_FILES['photo']['type'];
                
                $fileext=explode('.',$filename);
                $filecheck=strtolower(end($fileext));
               
                $destinationfile='../postes/'.$email.'/images/';
                $target_file=$destinationfile.basename($_FILES['photo']['name']);
                 $extensions=array("jpeg","jpg","png","webp","ARW");
                 $max_file_size = 200000000;
                 if (in_array($filecheck,$extensions)==false) {
                    ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                                      border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">votre photo est ajour</h5>
</div>
<?php
                            }
                            if (!file_exists ($destinationfile)) {
                             mkdir($destinationfile,0777,true);
                             }
                           move_uploaded_file($tmp,$target_file);
                          $url=$_SERVER['HTTP_REFERER'];
                          $seg=explode('/',$url);
                          $path=$seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
                          $full_url=$path.'/'.'assets/postes/'.$email.'/images/'.$filename;
             $sql="UPDATE `item` SET `image`=:full_url where idItem = :getid";
            
             $statement=$pdo->prepare($sql);
             $statement->bindParam(':full_url',$full_url);
             $statement->bindParam(':getid',$getid);
             $statement->execute();
             if($statement){
                ?>
<div style="background-color:#45FFCA;display:flex;justify-content:center; align-items:center;
                                                      border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">votre photo est modifié</h5>
</div>
<?php
             }else{
                ?>
<div style="background-color:#d94350;display:flex;justify-content:center; align-items:center;
                                                                      border-radius:5px;padding:10px 20px;">
    <h5 style="color: #f2f2f2;font-size:18px">oups veuillez recommencer</h5>
</div>
<?php 
             }
                
        }
    }
}catch(PDOException $e){
    echo"error:".$e->getMessage();
}