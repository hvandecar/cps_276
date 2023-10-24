<?php
if(count($_POST) > 0){
  require_once 'assignment5_php.php';
  $newFile = new addingFile();
  $msg = $newFile->newAddingFile();
}
else{
  $msg = "";
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

    <title>File and Directory</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <form action="assignment5.php" method="post">
        <h1>File and Directory Assignment</h1>
        <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>
        <p id="fileLocation"><?php echo $msg; ?></p>
        <div class="form-group">
          <label for="folder name">Folder Name</label>
          <input type="text" class="form-control" name="name" id="name" value="">
        </div>
        <div class="form-group">
          <label for="file content">File Content</label>
          <textarea style="height: 500px;" class="form-control" id="content" name="content"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submitButton" id="submitButton" value="Submit" />
      </form>
    </main>
  </body>
</html>