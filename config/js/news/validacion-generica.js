$(document).ready(function() {
    $("form").attr("autocomplete", "off");
    $('.no-simbolos').on('input', function() {
        this.value = this.value.replace(/^[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]*$/, '');
    });
    $('.solo-numeros').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('.letras_numeros').on('input', function() {
        this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
    });
    $(".solo-letras").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
          event.preventDefault();
          return false;
      }
      });
    $('.no-acentos').on('input', function() {
        this.value = this.value.replace(/[áéíóúüÁÉÍÓÚÄËÏÖÜ]/g, '');
    });
    $(".no-espacios").keyup(function() {
        this.value = this.value.replace(/ /g, "");
    });
});

var telefono = new Array(4, 3, 2, 2); // Patron para telefono
var cuenta_bancaria = new Array(4, 4, 2, 10); // Patron para Cuent Bancaria
var cedula = new Array(1, 10); // Patron para Numero de Cedula
var RIF = new Array(1, 8, 1); // Patron para Registro de Informacion Fiscal
var fecha =new Array(2, 2, 4); // Patron para Fecha (dd/mm/aaaa)

function validacion_inputs_generica(input, condicion, validador, mensaje) {
    if (input.value == condicion) {
        input.style.borderColor = 'red';
        validador.innerHTML = mensaje;
    } else {
        input.style.borderColor = '';
        validador.innerHTML = '';
    }
}

function Limitar(event, cantidad) {
    if (event.value.length >= cantidad) {
        event.value = event.value.substring(0, cantidad);
    }
}

function Filtro(d,sep,pat,nums){
    if(d.valant != d.value){
        val = d.value;
        largo = val.length;
        val = val.split(sep);
        val2 = '';
        for(r=0;r<val.length;r++){
            val2 += val[r];
        }

        if(nums){
            for(z=0;z<val2.length;z++){
                if(isNaN(val2.charAt(z))){
                    letra = new RegExp(val2.charAt(z), "g");
                    val2 = val2.replace(letra, "");
                }
            }
        }

        val = '';
        val3 = new Array();

        for(s=0; s<pat.length; s++){
         val3[s] = val2.substring(0, pat[s]);
         val2 = val2.substr(pat[s]);
     }

     for(q=0;q<val3.length; q++){
        if(q ==0){
            val = val3[q];
        }
        else{
            if(val3[q] != ""){
                val += sep + val3[q];
            }
        }
    }
    d.value = val;
    d.valant = val;
}
}

function validarkeypress(er,e){
    
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key);
    
    a = er.test(tecla);
    if(!a){
        e.preventDefault();
    }
    
    
}

function validarkeyup(er,etiqueta,etiquetamensaje,
mensaje){
    a = er.test($(etiqueta).val());
    
    if(a){
        $(etiquetamensaje).text("");
    }
    else{
        $(etiquetamensaje).text(mensaje);
    }
}
