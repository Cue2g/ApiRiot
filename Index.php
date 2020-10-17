<?php require('Data/Minibackend/Conexion.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Riot</title>
    <link rel="stylesheet" href="Data\Styles\uikit.min.css">
    <script src="Data\Js\uikit.min.js"></script>
    <script src="Data\Js\uikit-icons.min.js"></script>

</head>

<body>

    <div class="container">

        <form action="" method="GET" class="uk-padding">

            <div class="uk-margin">
                <label for="summoner"></label>
                <input name="summoner" class="uk-input" type="Nombre Summoner">
            </div>

            <div class="uk-margin">
                <label for="region"></label>
                <select name="region" class="uk-select">
                    <option>LAN</option>
                    <option>LAS</option>
                </select>
            </div>

            <div class="uk-margin">
                <button class="uk-button" type="submit">Enviar</button>
            </div>

        </form>
    </div>




    <?php if (!empty($cuenta)) {
        require('Data\Minibackend\Cuenta.php');
    } ?>




</body>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="Data\Js\axios.min.js"></script>
<script src="Data\Js\Js.js"></script>



</html>