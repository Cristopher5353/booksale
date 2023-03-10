$(document).ready(function() {
    $.ajax({
        url: '/admin/getFiveBestBooks',
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            let xValues = [];
            let yValues = [];
            let barColors = ["#3A7DEB", "#06E192","#EC5016","#C623F7","#F3E831"];

            resp.fiveBestBooks.forEach(element => {
                xValues.push(element.title);
                yValues.push(element.quantity);
            });

            new Chart("chartFiveBestProducts", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Top 5 productos más vendidos"
                    }
                }
            });
        }
    });

    $.ajax({
        url: '/admin/getSalesPerMonth',
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            let xValues = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            let yValues = [0,0,0,0,0,0,0,0,0,0,0,0];

            resp.salesPerMonth.forEach(element => {
                yValues[element.month - 1] = element.total;
            });

            new Chart("chartSalesPerMonth", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: "S/ ",
                        backgroundColor: "rgba(46, 134, 193)",
                        borderColor: "rgba(46, 134, 193)",
                        data: yValues,
                        fill: false
                    }]
                },
                options:{
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Ventas por mes (año " + new Date().getFullYear() + ")"
                    }
                }
            });
        }
    });

    $.ajax({
        url: '/admin/getFiveBestCustomers',
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            let xValues = [];
            let yValues = [];
            let barColors = ["#3A7DEB", "#06E192","#EC5016","#C623F7","#F3E831"];

            resp.fiveBestCustomers.forEach(element => {
                xValues.push(element.user);
                yValues.push(element.total);
            });

            new Chart("chartFiveBestCustomers", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: "S/ ",
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Top 5 mejores Clientes"
                    }
                }
            });
        }
    });
})