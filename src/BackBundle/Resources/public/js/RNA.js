RNA = function () {
    this.init();
};

RNA.prototype.init = function() {
    this.initConsultarRed();
};

RNA.prototype.initConsultarRed = function () {
    $('#consultar').click(function () {
        $("#consultar").addClass('disabled');
        $("#loader").show();
        
        var lote = $('select[name=lote]').val();
        var rotacion = $('#rotacion:checkbox:checked').length > 0;
        var mes = $("#mes").val();

        var respuesta = getBestOption(lote, rotacion, mes);
        
        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }
        sleep(10000).then(() => {
            $('#respuesta').text(respuesta.message);
            $("#consultar").removeClass('disabled');
            $("#loader").hide();
        });
    });
};

$(document).ready(function(){
    new RNA();
});