<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
</head>
<h1>Gallery</h1>
<body>
<?php
    require_once 'config/setup.php';

    try
    {
        $stmt = "SELECT * FROM gallery";
        $res = $connection->query($stmt);
        while ($new = $res->fetch())
        {
            echo "<td><img src=\"".$new['img']."\" alt=\"\" class='gallery' width='500' height='400'></td>";
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
</body>
</html>