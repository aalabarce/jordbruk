var Script = function () {
    $(function () {
        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: Routing.generate('terreno_cultivado'),
            success: function (data) {
                Morris.Donut({
                    element: 'historico',
                    data: data.historico,
                    colors: [
                        '#333333', 
                        '#a6c732',
                        '#a31915', 
                        '#1792a4', 
                        '#e47c5d', 
                        '#f9d422', 
                        '#9a4a5e'
                    ],
                    formatter: function (y) {
                        return y + " ha";
                    }
                });

                if (data.actual.length > 0){
                    Morris.Donut({
                        element: 'actual',
                        data: data.actual,
                        colors: [
                            '#333333', 
                            '#a6c732',
                            '#a31915', 
                            '#1792a4', 
                            '#e47c5d', 
                            '#f9d422', 
                            '#9a4a5e'
                        ],
                        formatter: function (y) {
                            return y + " ha";
                        }
                    });
                } else {
                    Morris.Donut({
                        element: 'actual',
                        data: [{label:"No tenes ningún cultivo", value:0}],
                        colors: ["#928f8f"],
                        formatter: function (y) {
                            return "";
                        }
                    });
                }
            }
        });

        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: Routing.generate('rinde_promedio_anual'),
            success: function (data) {
                Morris.Bar({
                    element: 'rinde',
                    data: data["datos"],
                    xkey: 'y',
                    ykeys: data["cultivos"],
                    labels: data["cultivos"],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    hideHover: 'auto',
                    barColors: [
                        '#333333', 
                        '#a6c732',
                        '#a31915', 
                        '#1792a4', 
                        '#e47c5d', 
                        '#f9d422', 
                        '#9a4a5e', 
                    ],
                });
            }
        });

        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url: Routing.generate('beneficios_anuales'),
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
                    barColors: [
                        '#43591d', 
                        '#a6c732',
                        '#a31915', 
                        '#1792a4', 
                        '#e47c5d', 
                        '#f9d422', 
                        '#9a4a5e', 
                    ],
                });
                
                if (!data.length) {
                    $("#graficos").hide();
                    $("#mensaje").show();
                }
            }
        });
    });
}();




