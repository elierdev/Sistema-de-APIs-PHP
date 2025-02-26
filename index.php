<?php
  require "motor.php";
?>

<!DOCTYPE html>
<html class="theme-dark" lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  <link rel="shortcut icon" href="api.png" type="image/x-icon">
  <title>Sistema APIs</title>
</head>

<body>
  
  <!-- Cabeza -->
  <?php include "cabeza.php"; ?>

  <!-- Contenido -->
  <div style="width: 90%; margin: 40px auto;">
  <h1 class="title">Ejercicios</h1>
  <br>
  <?php 
    foreach ($exercices as $exercice) {
      echo "<h2 class='title is-4'>{$exercice["name"]}</h2>" . "<h3 class='subtitle is-5'>{$exercice["description"]}</h3>" . "<a class='button is-link' href='{$exercice["link"]}'>Ver API</a>" . "<br>";
    }
  ?>
  </div>
  



</body>

</html>