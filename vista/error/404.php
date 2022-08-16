<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include (call."Style-404.php"); ?> 
    <title>
        404 ERROR!
    </title>
    <link rel="stylesheet" href="<?php echo constant('URL')?>config/plugins/bootstrap/css/bootstrap.min.css"> 
</head>
<body>

    <div class="row" style="position: absolute;top: 70%;left: 25%;">
        <div class="col-10">
            <center>
                <h1 class="">
                    <a href="<?php echo constant('URL');?>Inicio/" class='btn btn-primary'>Regresar </a>
                </h1>
            </center>
        </div>
        <div class="col-12">
            <h2 class="" style="color: gray;">
                Detalles:
            </h2>
            <p style="color: gray;">
                <?php 
                    foreach ($this->mensaje as $key => $error) {
            echo $error."</br>";
        }
                 ?>
            </p>
        </div>
    </div>

</body>
</html>