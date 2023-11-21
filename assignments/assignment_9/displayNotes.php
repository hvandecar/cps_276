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
  <title>Sorting Notes</title>
</head>
<body>
<main class="container">
      <h1>Display Note</h1>
      <p><a href="index.php" style="text-decoration: none;">Add Note</a></p>
      <form action="#" method="post" enctype="multipart/form-data">  
        <div class="mb-3">
          <label for="begDate" class="form-label">Beginning Date</label>
          <input type="date" class="form-control" id="begDate" name="begDate">
        </div>
        <div class="mb-3">
          <label for="endDate" class="form-label">Ending Date</label>
          <input type="date" class="form-control" id="endDate" name="endDate">
        </div>
        <input type="submit" class="btn btn-primary" name="submitButton" id="submitButton" value="Get Notes"/><br><br>
      </form>
      <?php echo $notes; ?>      
    </main>  
</body>
</html>