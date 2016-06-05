Datepicker = function () {
    this.init();
};

Datepicker.prototype.init = function() {    
    $(".fecha").datepicker({
        autoclose: true,
        language: 'es',
        format: 'dd-mm-yyyy',
        orientation: "top"
    });
};

$(document).ready(function(){
    new Datepicker();
});