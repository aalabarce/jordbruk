Siembra = function () {
    $("#siembra_cultivo").prop('disabled', true);
    $("#siembra_lote").prop('disabled', true);
    $("#siembra_fecha").prop('disabled', true);
    
    $('form').on('submit', function() {
        $("#siembra_cultivo").prop('disabled', false);
        $("#siembra_lote").prop('disabled', false);
        $("#siembra_fecha").prop('disabled', false);
    });
};

$(document).ready(function(){
    new Siembra();
});