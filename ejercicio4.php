<?php
require_once "motor.php";

$ciudad = "Santo%20Domingo"; // Valor por defecto
if (isset($_POST['ciudad']) && !empty($_POST['ciudad'])) {
    $ciudad = urlencode($_POST['ciudad']);
}

$url = "http://api.weatherapi.com/v1/current.json?key=bb05fab512284dd689f231800252402&q=$ciudad&aqi=no";
$response = file_get_contents($url);
$data = json_decode($response, true);
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
    <?php include "cabeza.php"; ?>

    <!-- Contenido -->
    <div style="width: 90%; margin: 40px auto;">
        <?php
            $numero_ejercicio = 4;
            $ejercicio = $exercices[$numero_ejercicio - 1];

            // Mostrar la información
            echo "<h1 class='title'>{$ejercicio["name"]}</h1>";
            echo "<h2 class='subtitle' style='margin: 0;'>{$ejercicio['description']}</h2>";
            echo "<a class='button' style='margin: 10px 0;' href='{$ejercicio['link']}' target='_blank'>Ver API</a>";
        ?>
        <form action="" method="post">
            <div class="field">
                <label class="label">Busca una ciudad</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Ingresa el nombre de una ciudad" name="ciudad">
                </div>
                <input style="margin: 15px 0;" class="button is-primary" value="Buscar" type="submit">
            </div>
        </form>
        
        <?php if (isset($data["location"])): ?>
        <div class="card">
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="<?php echo 'https:' . $data['current']['condition']['icon']; ?>" alt="Clima" />
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4"><?php echo $data["location"]["name"] . ", " . $data["location"]["region"]; ?></p>
                        <p class="subtitle is-6"><?php echo $data["location"]["country"]; ?></p>
                    </div>
                </div>
                <div class="content">
                    <p class="title is-3">Temperatura: <?php echo $data['current']['temp_c']; ?>°C</p>
                    <p><?php echo $data['current']['condition']['text']; ?></p>
                    <p class="subtitle is-5"> 
                        <b>Hora: </b><?php echo $data['location']['localtime']; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
