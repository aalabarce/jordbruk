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
        if(datos.crop) {
            var respuesta = "Se sugiere sembrar " + datos.crop;
        } else {
            var respuesta = datos.error;
        }
        if(datos.profit) {
            var ganancia = "Se proyecta una ganancia aproximada a $" + datos.profit;
        } else {
            respuesta = datos.error;
            var ganancia = "";
        }
        
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