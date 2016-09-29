RNA = function () {
    this.init();
};

RNA.prototype.init = function() {
    this.initConsultarRed();
//    
//    $.ajax({
//        type: 'GET',
//        dataType: "JSON",
//        url: Routing.generate('get_lotes'),
//        success: function (data) {
//            lots = data;
//            console.log(data);
//        }
//    });
//    
//    $.ajax({
//        type: 'GET',
//        dataType: "JSON",
//        url: Routing.generate('get_siembras'),
//        success: function (data) {
//            harvests = data;
//            console.log(data);
//        }
//    });
};

RNA.prototype.initConsultarRed = function () {
    $('#consultar').click(function () {
        $body = $("body");
        $body.addClass("loading");
        
        var lote = $('select[name=lote]').val();
        var rotacion = $('#rotacion:checkbox:checked').length > 0;
        var mes = $("#mes").val();

        var respuesta = getBestOption(lote, rotacion, mes);
        
        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }
        sleep(10000).then(() => {
            $body.removeClass("loading"); 
            $('#respuesta').text(respuesta.message);
        });
    });
};

$(document).ready(function(){
    new RNA();
});