<?php
require_once 'classes/FileProc.php';
$fileProc = new FileProc();
$arr = $fileProc->init();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>File Display</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <h1 style="text-align:center;">File Upload and Display</h1>
      <h2>Upload File</h2>
      <?php echo $arr[0]; ?>
      <form action="#" method="post" enctype="multipart/form-data">  
        <div class="mb-3">
          <label for="name" class="form-label">File Name</label>
          <input type="text" class="form-control" name="name" id="name" value="">
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Choose File</label>
          <input type="file" class="form-control" name="formFile" id="formFile">
        </div>
        <input type="submit" class="btn btn-primary" name="submitButton" id="submitButton" value="Upload File"/><br><br>
        <h2>Display File List</h2>
        <?php echo $arr[1]; ?>
      </form>
    </main>
  </body>
</html>