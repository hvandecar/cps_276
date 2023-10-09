<?php
$newList = "<ul>";
$sections = 4;
$listItems = 5;
for ($sec=1; $sec<=$sections; $sec++){
  $newList .= "<li>$sec<ul>";
  for ($list=1; $list<=$listItems; $list++) {
    $newList .= "<li>$list</li>";
  }
  $newList .= "</ul></li>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 2.1</title>
</head>
<body>
  <p><?php echo $newList?></p>
</body>
</html>