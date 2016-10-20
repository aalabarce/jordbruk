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
                        return y + " has"
                    }
                });

                Morris.Donut({
                    element: 'actual',
                    data: data.actual,
                    colors: ['blue', 'yellow', 'grey', 'red', 'pink', 'violet'],
                    formatter: function (y) {
                        return y + " has"
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




        Morris.Area({
            element: 'hero-area',
            data: [
                {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
                {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
                {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
                {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
                {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
                {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
                {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
                {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
                {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
                {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
            ],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            hideHover: 'auto',
            lineWidth: 1,
            pointSize: 5,
            lineColors: ['#4a8bc2', '#ff6c60', '#a9d86e'],
            fillOpacity: 0.5,
            smooth: true
        });



        $('.code-example').each(function (index, el) {
            eval($(el).text());
        });
    });

}();




