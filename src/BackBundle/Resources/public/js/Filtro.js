Filtro = function () {
    this.init();
};

Filtro.prototype.init = function() {    
    $("#limpiar").click(function() {
        $(".filtro").val("");
        $(".filtro").prop( "checked", false );;
  });
};

$(document).ready(function(){
    new Filtro();
});