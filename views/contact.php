<?php require __DIR__.'/inc/head.php'; ?>

<body>
  <header>
      <?php require __DIR__.'/inc/header.php.php'; ?>
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
  </main>
  <footer class="footer">
    <hr>
    <div>
      <h4>Footer 2022!</h4>
    </div>
  </footer>
</body>

</html>