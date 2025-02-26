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
        $numero_ejercicio = 9;
        $ejercicio = $exercices[$numero_ejercicio - 1];

        // Mostrar la información
        echo "<h1 class='title'>{$ejercicio["name"]}</h1>";
        echo "<h2 class='subtitle' style='margin: 0;'>{$ejercicio['description']}</h2>";
        echo "<a class='button' style='margin: 10px 0;' href='{$ejercicio['link']}' target='_blank'>Ver API</a>";
        ?>
        
        <form action="ejercicio9.php" method="post">
            <div class="field">
                <label class="label">Ingresa un nombre de país en inglés</label> 
                <div class="control">
                    <input class="input" type="text" placeholder="Dominican Republic" name="dato">
                </div>
                <input style="margin: 15px 0;" class="button is-primary" value="Enviar" type="submit" name="submit">
            </div>
        </form>

        <?php
        if (!empty($_POST['dato'])) {
            $dato_encoded = urlencode($_POST["dato"]);
            $url = "https://restcountries.com/v3.1/name/{$dato_encoded}";
            $response = @file_get_contents($url); 

            if ($response !== false) {
                $data = json_decode($response, true);

                if (!empty($data) && is_array($data)) {
                    $country = $data[0]; 
                    $flag = $country['flags']['svg'];
                    $name = $country['name']['common'];
                    $capital = isset($country['capital'][0]) ? $country['capital'][0] : "N/A";
                    $population = number_format($country['population']);

                    // Extraer las monedas disponibles
                    $currencies = [];
                    if (!empty($country['currencies'])) {
                        foreach ($country['currencies'] as $currency) {
                            $currencies[] = $currency['name'] . " ({$currency['symbol']})";
                        }
                    }
                    $currencies = !empty($currencies) ? implode(", ", $currencies) : "N/A";

                    echo "<div style='margin: 10px 0;'class='box'>
                        <div class='image 3by2'>
                            <img style='width: 320px; margin-bottom: 10px;'src='{$flag}' alt='Bandera de {$name}'>
                        </div>
                        <div class='media'>
                            <div class='media-content'>
                                <p class='title is-4'>{$name}</p>
                                <p class='subtitle is-6'><strong>Capital:</strong> {$capital}</p>
                                <p class='subtitle is-6'><strong>Población:</strong> {$population}</p>
                                <p class='subtitle is-6'><strong>Moneda:</strong> {$currencies}</p>
                            </div>
                        </div>
                    </div>";
                } else {
                    echo "<p class='notification is-danger'>No se encontraron datos para ese país.</p>";
                }
            } else {
                echo "<p class='notification is-danger'>Error al conectar con la API.</p>";
            }
        }
        ?>

    </div>
</body>

</html>
