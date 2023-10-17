<?php
if(count($_POST) > 0){
  require_once 'assignment4_php.php';
  $addName = new addingNames();
  $output = $addName->addClearNames();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Add Names</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <h1>Add Names</h1>
      <form action="assignment4_form.php" method="post">
      <input type="submit" class="btn btn-primary" name="submitButton" id="submitButton" value="Add Name" />
      <input type="submit" class="btn btn-primary" name="clearButton" id="clearButton" value="Clear Names" />
      <div class="form-group">
        <label for="enter name">Enter Name</label>
        <input type="text" class="form-control" name="name" id="name" value="">
      </div>
      <div class="form-group">
        <label for="list of names">List of Names</label>
        <textarea style="height: 500px;" class="form-control" id="nameCol" name="nameCol"><?php echo $output ?></textarea>
      </div>
      </form>
    </main>
  </body>
</html>