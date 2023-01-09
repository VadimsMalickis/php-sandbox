<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sandbox</title>
  <link rel="stylesheet" href="main.css" />
  <script src="main.js" defer></script>
</head>

<body>
  <header>
    <?php include "header.php"; ?>
  </header>
  <main>
    <form action="" method="post">
      <label for="text">
        <input id="text" type="text" placeholder="text input" name="vards">
      </label>
      <input type="password" placeholder="enter password here" name="parole">
      <input type="date" placeholder="date" name="datums">
      <input type="submit">
    </form>



    <?php

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      $name = $_POST['vards'];
      $password = $_POST['parole'];
      $date = $_POST['datums'];

      $response = sprintf("Result: %s, %s, %s", $name, $password, $date);

      echo $response;
    }


    ?>
  </main>
  <footer class="footer">
    <hr>
    <div>
      <h4>Footer 2022!</h4>
    </div>
  </footer>
</body>

</html>