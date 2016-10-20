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
                        return y + " has";
                    }
                });

                Morris.Donut({
                    element: 'actual',
                    data: data.actual,
                    colors: ['blue', 'yellow', 'grey', 'red', 'pink', 'violet'],
                    formatter: function (y) {
                        return y + " has";
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
    });
}();




