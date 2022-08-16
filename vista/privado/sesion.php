<?php
@session_start();
$var = $_SESSION['cedula'];
if ($var == null and $var == '') {
    echo '<script type="text/javascript" > 
    swal({title: "",   
        text: "Usted no ha iniciado sesion",
        type: "error",   
        timer: 3000,   
        showConfirmButton: false })
    "
    </script>';
    die();}
?>  