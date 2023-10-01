<?php 
$table = "<table border='1'>";
$row = 15;
$cell = 5;
for ($i=1; $i<=$row; $i++){
    $table .= "<tr>";
    for ($k=1; $k<=$cell; $k++){
        $table .= "<th>Row $i Cell $k</th>";
    }
    $table .= "</tr>";
}
$table .= "</table>";
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 2.3</title>
</head>
<body>

    <h1><?php echo $table ?></h1>
    
</body>
</html>