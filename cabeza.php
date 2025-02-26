<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            
            <p>📗 <b>TAREA 5</b></p>

        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Inicio
            </a>
            <a class="navbar-item" href="acerca-de.php">
                Acerca de
            </a>



            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Ejercicios
                </a>

                <!-- Dropdown menu-->
                <div class="navbar-dropdown">
                    <?php
                    foreach ($exercices as $exercice) {
                        echo "<a class='navbar-item' href='{$exercice["src"]}'>{$exercice["name"]}</a>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-primary" href="#">Luis Elier Pujols</a>
                </div>
            </div>
        </div>
    </div>
</nav>