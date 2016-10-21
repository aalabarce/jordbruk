var Script = function () {
    $(function () {
        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: '/terreno_cultivado',
            success: function (data) {
                Morris.Donut({
                    element: 'historico',
                    data: data.historico,
                    colors: ['blue', 'yellow', 'grey', 'red', 'pink', 'violet'],
                    formatter: function (y) {
                        return y + " ha";
                    }
                });

                Morris.Donut({
                    element: 'actual',
                    data: data.actual,
                    colors: ['blue', 'yellow', 'grey', 'red', 'pink', 'violet'],
                    formatter: function (y) {
                        return y + " ha";
                    }
                });
            }
        });

        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: '/rinde_promedio_anual',
            success: function (data) {
                Morris.Line({
                    element: 'rinde',
                    data: data["datos"],
                    xkey: 'y',
                    ykeys: data["cultivos"],
                    labels: data["cultivos"],
                    lineColors: ['blue', 'yellow', 'grey', 'red', 'pink', 'violet']
                });
            }
        });

        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: '/beneficios_anuales',
            success: function (data) {
                Morris.Bar({
                    element: 'beneficios',
                    data: data,
                    xkey: 'year',
                    ykeys: ['beneficio'],
                    labels: ['Beneficio'],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    hideHover: 'auto',
                    barColors: ['#ac92ec']
                });
                
                if (!data.length) {
                    $("#graficos").hide();
                    $("#mensaje").show();
                }
            }
        });
    });
}();




