<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        500 ERROR!
    </title>
    <link rel="stylesheet" href="<?php echo constant('URL')?>config/plugins/bootstrap/css/bootstrap.min.css"> 
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <center>
                <img src="<?php echo constant('URL')?>config/img/web/500.png" alt="">
            </center>
        </div>
    </div>
    <div class="row" style="position: absolute;top: 50%;left: 30%;">
        <div class="col-12">
            
        </div>
        <div class="col-12">
            <h2 class="" style="color: gray;">
                Detalles:
            </h2>
            <p style="color: gray;margin-left: 40px;">
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