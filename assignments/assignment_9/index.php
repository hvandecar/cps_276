<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Adding Notes</title>
</head>
<body>
<main class="container">
      <h1>Add Note</h1>
      <p><a href="displayNotes.php" style="text-decoration: none;">Display Notes</a></p>
      <?php echo $notes; ?>
      <form action="#" method="post" enctype="multipart/form-data">  
        <div class="mb-3">
          <label for="dateTime" class="form-label">Date and Time</label>
          <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
        </div>
        <div class="mb-3">
          <label for="note" class="form-label">Note</label>
          <textarea type="text" class="form-control" id="note" name="note" rows="10" cols="50"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submitButton" id="submitButton" value="Add Note"/><br><br>
      </form>
    </main>  
</body>
</html>