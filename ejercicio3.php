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
        $numero_ejercicio = 3;
        $ejercicio = $exercices[$numero_ejercicio - 1];

        // Mostrar la información
        echo "<h1 class='title'>{$ejercicio["name"]}</h1>";
        echo "<h2 class='subtitle' style='margin: 0;'>{$ejercicio['description']}</h2>";
        echo "<a class='button' style='margin: 10px 0;' href='{$ejercicio['link']}' target='_blank'>Ver API</a>";
        ?>
        <form action="ejercicio3.php" method="post">
            <div class="field">
                <label class="label">Nombre un país</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Ingresa el nombre de un país para mostrar las uiniversidades" name="dato">
                </div>
                <input style="margin: 15px 0;" class="button is-primary" value="Enviar" type="submit" name="submit">
            </div>

            <?php
            if (!empty($_POST['dato'])) {
                $url = "http://universities.hipolabs.com/search?country=" . urlencode($_POST["dato"]);
                $response = file_get_contents($url);
                $universidades = json_decode($response, true); // No necesitas envolver en otro array

                // Mostrar los datos
                echo "<h2 class='title is-4'>Resultados</h2><br>";

                foreach ($universidades as $universidad) {
                    $nombre = $universidad['name'];  
                    $dominio = !empty($universidad['domains']) ? implode(", ", $universidad['domains']) : "No disponible";  
                    $pagina_web = !empty($universidad['web_pages'][0]) ? $universidad['web_pages'][0] : "No disponible";  

                    echo "<div class='box'>
                    <h3 class='title is-5'>$nombre</h3>
                    <p><strong>Dominio:</strong> $dominio</p>
                    <p><strong>Página web:</strong> <a href='$pagina_web' target='_blank'>$pagina_web</a></p>
                    </div>";
            
                }
            } else {
                echo "<p>No se ha proporcionado un país.</p>";
            }


            ?>
    </div>
    </form>



</body>

</html>