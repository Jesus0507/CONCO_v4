$(document).ready(function() {
    document.getElementById("foto").onchange = function(e) {
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();
        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);
        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function() {
            let preview = document.getElementById('preview'),
                image = document.createElement('img');
            image.src = reader.result;
            $("#preview").html('<img  class="img-circle" width="100" src="' + image.src + '" >');
            $("#preview_modal").html('<img  class="img-circle" width="80" src="' + image.src + '" >');
        };
    }
});