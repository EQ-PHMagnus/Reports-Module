$(document).ready(function () {
    // check if chart view is true
    var chartView = $('input[name=chart]').attr('id');
    if(chartView == "true"){
        console.log('lay')
        initializeCharts();
    }else{
    }
    // initialize charts
    function initializeCharts(){
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
        });

        let barGraphOptions = {
            axisY: {
                onlyInteger : true
            },
            height: '300px'
        };
        // CHARTS
        $.get(adminUrl + "dashboard/total-bets?search=&count=true",{
            from: $('input[name="from"]').val(),
            to: $('input[name="to"]').val(),
            group: $('select[name="group"]').val(),
            chart: $('input[name="chart"]').val()
        }).done(function(data){
            // TOTAL BETS - NUMBER 
            console.log(data.chartBarNumber);
            new Chartist.Bar('.number-bets',  
            {
                labels: data.chartBarNumber.labels,
                series: [
                    [5, 4, 3, 7],
                    [3, 2, 9, 5],
                    [1, 5, 8, 4],
                    [2, 3, 4, 6],
                    [4, 1, 2, 1]
                  ]
            },  {
            showLabel: false,
            // plugins: [
            //     Chartist.plugins.legend(),
            //     Chartist.plugins.tooltip()
            // ]
            });
        });


        $.get(adminUrl + "dashboard/total-bets?search=&count=true",{
            from: $('input[name="from"]').val(),
            to: $('input[name="to"]').val(),
            group: $('select[name="group"]').val(),
            chart: $('input[name="chart"]').val()
        }).done(function(data){
            // TOTAL BETS - NUMBER 
            console.log(data.chartBarNumber);
            new Chartist.Bar('.amount-bets',  
            {
                labels: data.chartBarNumber.labels,
                series: [
                    [5, 4, 3, 7],
                    [3, 2, 9, 5],
                    [1, 5, 8, 4],
                    [2, 3, 4, 6],
                    [4, 1, 2, 1]
                  ]
            },  {
            showLabel: false,
            // plugins: [
            //     Chartist.plugins.legend(),
            //     Chartist.plugins.tooltip()
            // ]
            });
        });
    }
    // filter functions
    $('.btn-filter-table').on('click',function () {
        $('table[data-toggle="table"]').bootstrapTable('refresh');
    }); 
    $('.btn-filter-chart').on('click',function () {
        initializeCharts();
    });
});