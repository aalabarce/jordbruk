Zona = function () {
    this.init();
};

Zona.prototype.init = function () {
    Zona.vaciarLocalidades();
    $(".provincia option:first").text("Seleccione una provincia");
    this.initCargarLocalidades();
};

Zona.prototype.initCargarLocalidades = function () {
    $('.provincia').change(function () {
        if(!$('.provincia').val())
            return;

        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: Routing.generate('get_localidades') + "/" + $('.provincia').val(),
            success: function (data) {
                Zona.vaciarLocalidades();

                var opciones = Array();
                $.each(data, function (key, value) {
                    opciones.push(new Option(value, key));
                });
                opciones.sort(function (a, b) {
                    return $(a).text() > $(b).text() ? 1 : -1;
                });
                
                $('.localidad').append(opciones);

                if (Object.keys(data).length == 1) {
                    $('.localidad').find("option:eq(1)").attr("selected", "selected").change();
                } else {
                    $('.localidad').find("option:eq(0)").attr("selected", "selected").change();
                }
            }
        });
    });
};

Zona.vaciarLocalidades = function () {
    $('.localidad').children().remove();
    $('.localidad').append(new Option("Seleccione una localidad", ""));
}

$(document).ready(function () {
    new Zona();
});