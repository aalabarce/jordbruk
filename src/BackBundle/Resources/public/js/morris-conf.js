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
//                    colors: ['#5fb677','#91c470','#bed57e','#c5c68a','#dddd95'],
                    colors: ['#a6c732','#b9d162','#ccdd91','#e0ebc2','#5bbec0'],
//                    colors: ['#1792a4','#44b4c4','#80c9c6','#a3d5d1','#c8e5e3'],
                    formatter: function (y) {
                        return y + " ha";
                    }
                });

                Morris.Donut({
                    element: 'actual',
                    data: data.actual,
//                    colors: ['#5fb677','#91c470','#bed57e','#c5c68a','#dddd95'],
                    colors: ['#a6c732','#b9d162','#ccdd91','#e0ebc2','#5bbec0'],
//                    colors: ['#1792a4','#44b4c4','#80c9c6','#a3d5d1','#c8e5e3'],
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
//                    lineColors: ['#5fb677','#91c470','#bed57e','#c5c68a','#dddd95']
                    lineColors: ['#a6c732','#b9d162','#ccdd91','#e0ebc2','#5bbec0']
//                    lineColors: ['#1792a4','#44b4c4','#80c9c6','#a3d5d1','#c8e5e3']
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




