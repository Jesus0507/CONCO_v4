<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <style type="text/css">
body{
    margin: 0px;
    padding: 0px;
     background-image: url("<?php echo constant('BASE_URL')?>config/img/web/404-2.png");
    background-repeat: no-repeat;/*<------------------NO REPETIR LA IMAGEN DE EL ENCABEZADO*/
    background-size: cover;/*<------------------------ADAPTA EL TAMAÑO DE LA IMAGEN*/
    color: white;
    font-family: Helvetica, Arial;
}
</style> 
    <title>
        404 ERROR!
    </title>
    <link rel="stylesheet" href="<?php echo constant('BASE_URL')?>config/plugins/bootstrap/css/bootstrap.min.css"> 
</head>
<body>

    <div class="row" style="position: absolute;top: 70%;left: 25%;">
        <div class="col-10">
            <center>
                
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