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

        lineGraphOptions = {
            low: 0,
            showArea: true,
            height: '300px',
           
            chartPadding: {
                left: 30
            },
            // plugins: [
            //     Chartist.plugins.legend(),
            //     Chartist.plugins.tooltip()
            // ]
        };
        
        // CHARTS - COUNT
        $.get(adminUrl + "dashboard/total-bets?search=&count=true",{
            from: $('input[name="from"]').val(),
            to: $('input[name="to"]').val(),
            group: $('select[name="group"]').val(),
            chart: $('input[name="chart"]').val()
        }).done(function(data){
            // TOTAL BETS - NUMBER 
            new Chartist.Line('.number-bets',  
            data.chartBarNumber,lineGraphOptions);

            new Chartist.Line('.amount-bets',  
            data.chartBarAmount,{  low: 0,
                showArea: true,
                height: '300px',
               
                chartPadding: {
                    left: 30
                }, axisY: {
                labelInterpolationFnc: function(value,idx) {
                    return formatter.format(value);     
                }
            },});
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