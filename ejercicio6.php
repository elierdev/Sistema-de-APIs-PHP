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
    <title>Noticias desde WordPress 📰</title>
</head>

<body>

    <!-- Cabeza -->
    <?php include "cabeza.php"; ?>

    <!-- Contenido -->
    <div style="width: 90%; margin: 40px auto;">
        <?php
        $numero_ejercicio = 6;
        $ejercicio = $exercices[$numero_ejercicio - 1];

            // Mostrar la información
            echo "<h1 class='title'>{$ejercicio["name"]}</h1>";
            echo "<h2 class='subtitle' style='margin: 0;'>{$ejercicio['description']}</h2>";
            echo "<a class='button' style='margin: 10px 0;' href='{$ejercicio['link']}' target='_blank'>Ver API</a>";
            ?>

        <div class="section">
            <div class="container">
                <h2 class="title">Últimas Noticias</h2>
                <?php
                // URL de la API de WordPress
                $url = "https://public-api.wordpress.com/rest/v1.1/freshly-pressed/";
                
                // Obtener los datos de la API
                $response = file_get_contents($url);
                $data = json_decode($response, true);
                
                // Verificar si la respuesta es válida
                if ($data && isset($data["posts"])) {
                    foreach (array_slice($data["posts"], 0, 10) as $post) {
                        $title = $post["title"];
                        $link = $post["URL"];
                        $excerpt = strip_tags($post["excerpt"]);
                        $blog_name = $post["site_name"];
                ?>
                        <div class="box">
                            <article class="media">
                                
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong><?php echo $title; ?></strong> <small><?php echo $blog_name; ?></small><br>
                                            <?php echo $excerpt; ?>
                                            <br>
                                            <a href="<?php echo $link; ?>" class="button is-info is-small" target="_blank">Leer más</a>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No se pudieron obtener las noticias.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>
