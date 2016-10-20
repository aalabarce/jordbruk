Zona = function () {
    this.init();
};

Zona.prototype.init = function () {
    var localidad = $(".localidad").val();
    var provincia = $(".provincia").val();
//    alert(localidad);
//    alert(provincia);
    Zona.vaciarLocalidades();
    if (localidad)
        Zona.cargarLocalidades(localidad);
    
    if($(".provincia option[value='']"))
        $(".provincia option[value='']").remove();
    $('.provincia').prepend(new Option("Seleccione una provincia", ""));
    if (provincia) 
        $(".provincia").val(provincia);
    else
        $('.provincia').find("option:eq(0)").prop('selected', true);
    
    this.initCargarLocalidades();
};

Zona.prototype.initCargarLocalidades = function () {
    $('.provincia').change(function () {
        if($('.provincia').val())
            Zona.cargarLocalidades();
    });
};

Zona.cargarLocalidades = function (localidad) {
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

            if (localidad) {
                $('.localidad option[value='+localidad+']').prop('selected', true);
            } else {
                if (Object.keys(data).length == 1) {
                    $('.localidad').find("option:eq(1)").prop('selected', true);
                } else {
                    $('.localidad').find("option:eq(0)").prop('selected', true);
                }
            }
        }
    });    
};

Zona.vaciarLocalidades = function () {
    $('.localidad').children().remove();
    $('.localidad').append(new Option("Seleccione una localidad", ""));
};

$(document).ready(function () {
    new Zona();
});