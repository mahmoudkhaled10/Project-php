<?php
require_once("conn.php");

if (!isset($_GET["q"])) {
    header("Location:index.php");
    return;
}

$q = $_GET["q"];


$query = "SELECT Name FROM country WHERE Code=:q;";
$stm = $pdo->prepare($query);
$stm->execute([
    ':q' => $q,
]);

$countryName = $stm->fetch(PDO::FETCH_ASSOC);

if (!$countryName) {
    header("Location:index.php");
    return;
}


$query = "SELECT * FROM city WHERE CountryCode=:q; ";
$stm = $pdo->prepare($query);
$stm->execute([
    ':q' => $q,
]);
$allCities = $stm->fetchAll(PDO::FETCH_ASSOC);






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
                        <h2 class="text-center">
                            <?php echo $countryName['Name'] ?> Cities</h2>
                        <?php if (count($allCities) > 0) { ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Population</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allCities as $k => $record) { ?>
                                        <tr>
                                            <td><?php echo $k + 1 ?></td>
                                            <td><?php echo $record["Name"] ?></td>
                                            <td><?php echo $record["Population"] ?></td>
                                            <td><a class="del" href="city.php?op=del&q=<?php echo $record["ID"] ?>">
                                                    Delete
                                                </a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>

                            <div class="alert alert-warning">
                                <p class="m-0">
                                    There are no city
                                </p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('a.del').click(function(ev) {
                var isConfirmed = confirm("are u sure");
                if (!isConfirmed) {
                    ev.preventDefault();
                }
            });
        })
    </script>
</body>

</html>