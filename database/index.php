<?php
require_once("conn.php");
session_start();

$query="SELECT * FROM country LIMIT 0,20;";
$stm=$pdo->query($query);

 $allRecords=$stm->fetchAll(PDO::FETCH_ASSOC);

// foreach($allRecords as $row){
//     print_r($row);
//     echo "<br>";
// }

// print_r($allRecords);

// while($row=$stm->fetch(PDO::FETCH_ASSOC)){
//     print_r($row);
// }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>index</title>
</head>
<body>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
                   <div class="card shadow border">
                        <div class="card-body">
                            <h2 class="text-center">Countries</h2>
                            <hr>
                             <?php include_once("success.php")?>
                            <table class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Continent</th>
                                          <th>Region</th>
                                          <th>SurfaceArea</th>
                                          <th>link</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach($allRecords as $k=>$record){?>
                                      <tr>
                                          <td><?php echo $k +1 ?></td>
                                          <td><?php echo $record["Name"] ?></td>
                                          <td><?php echo $record["Continent"] ?></td>
                                          <td><?php echo $record["Region"] ?></td>
                                          <td><?php echo $record["SurfaceArea"] ?></td>
                                          <td><a href="cities.php?q=<?php echo $record["Code"]?>">
                                                   View Cities
                                            </a></td>
                                      </tr>
                                      <?php }?>
                                  </tbody>
                            </table>
                        </div>
                   </div>
        </div>
    </div>
</div>    



<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>