<?php
require_once "motor.php";
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
        <?php
        $numero_ejercicio = 2;
        $ejercicio = $exercices[$numero_ejercicio - 1];

        // Mostrar la información
        echo "<h1 class='title'>{$ejercicio["name"]}</h1>";
        echo "<h2 class='subtitle' style='margin: 0;'>{$ejercicio['description']}</h2>";
        echo "<a class='button' style='margin: 10px 0;' href='{$ejercicio['link']}' target='_blank'>Ver API</a>";
        ?>
        <form action="ejercicio2.php" method="post">
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Ingresa un nombre" name="dato">
                </div>
                <input style="margin: 15px 0;"class="button is-primary" value="Enviar" type="submit" name="submit">
            </div>

            <?php



            if (!empty($_POST['dato'])) {
                $url = "https://api.agify.io/?name=" . urlencode($_POST["dato"]);
                $response = file_get_contents($url);
                $data = json_decode($response, true);

                // Mostrar los datos
                echo "  <p class='button is-success'>El nombre es " . $data["name"] . " y esspeculo que tenga  " . $data["age"] . " años de edad.</p>";
                
            } else {
                echo "";
            }


            ?>
    </div>
    </form>



</body>

</html>