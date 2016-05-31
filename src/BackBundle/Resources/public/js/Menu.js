Menu = function () {
    this.init();
}

Menu.prototype.init = function() {
    this.initActive();
}

Menu.prototype.initActive = function() {
    var url = window.location.href.split('?')[0];
    if (url.indexOf("lote") != -1) {
        $("#lote").addClass("active");
        $("#datos").click ();
    } else if (url.indexOf("siembra") != -1) {
        $("#siembra").addClass("active");
        $("#datos").click ();
    } else if (url.indexOf("cosecha") != -1) {
        $("#cosecha").addClass("active");
        $("#datos").click ();
    } else if (url.indexOf("rna") != -1) {
        $("#rna").addClass("active");
    } else {
        $("#home").addClass("active");
    }
}

$(document).ready(function(){
    new Menu();
});