<?php require __DIR__.'/inc/head.php'; ?>

<body>
<header>
    <?php require __DIR__.'/inc/header.php'; ?>
</header>
  <main>
    <h1>Greeting <?php echo $name ;?>!</h1>
    <h3>Your age is <?php echo $age ;?></h3>
    <ul>
      <li><img src="<?php echo '/../img/1.png'; ?>" alt=""></li>
      <li><img src="<?php echo '/../img/2.png'; ?>" alt=""></li>
      <li><img src="<?php echo '/../img/3.png'; ?>" alt=""></li>
    </ul>

  </main>
  <footer class="footer">
    <hr>
    <div>
      <h4>Footer 2022!</h4>
    </div>
  </footer>

</body>

</html>