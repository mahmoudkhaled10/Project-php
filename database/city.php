<?php
require_once("conn.php");
session_start();

if(!isset($_GET["q"]) || !isset($_GET["op"])){
       header("Location:index.php");
       return;
}

$q=$_GET["q"];
$op=$_GET["op"];
$str=strcmp($op ,"del");

if($str == 0){

    $query="DELETE FROM city WHERE ID=:q";
    $stm=$pdo->prepare($query);
    $stm->execute([
        ':q'=>$q,
    ]);
    $_SESSION["success"]="city is deleted";
}

header("Location:index.php");
return;












?>