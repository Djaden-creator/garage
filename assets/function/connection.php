<?php
try{
    $user="root";
    $database="garage";
    $password = getenv('');
    $host="localhost";

    $pdo = new PDO('mysql:$host;dbname=garage', $user, $password);
    
}catch(PDOException $e) {
    file_put_contents('dblogs.log', $e->getMessage().PHP_EOL, FILE_APPEND);
  echo "oups impossible de nous connecter";
}