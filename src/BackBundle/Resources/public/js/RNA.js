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

        var datos = getBestOption(lote, rotacion, mes);
        console.log(datos)
        var respuesta = datos.crop;
        var ganancia = datos.message;
        
        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }
        
        sleep(2000).then(() => {
            $('#respuesta').text(respuesta);
            $('#ganancia').text(ganancia);
            $("#consultar").removeClass('disabled');
            $("#loader").hide();
        });
    });
};

$(document).ready(function(){
    new RNA();
});