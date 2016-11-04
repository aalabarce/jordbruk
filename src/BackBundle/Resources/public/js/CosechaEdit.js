Cosecha = function () {
//    $("#cosecha_beneficio").prop('disabled', true);
    $("#cosecha_rinde").prop('disabled', true);
    $("#cosecha_fecha").prop('disabled', true);
    $("#cosecha_siembra").prop('disabled', true);
    
    $('form').on('submit', function() {
//        $("#cosecha_beneficio").prop('disabled', false);
        $("#cosecha_rinde").prop('disabled', false);
        $("#cosecha_fecha").prop('disabled', false);
        $("#cosecha_siembra").prop('disabled', false);
    });

};

$(document).ready(function(){
    new Cosecha();
});