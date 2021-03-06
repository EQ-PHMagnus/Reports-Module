$(document).ready(function () {
  
    initializeCharts()
    // initialize charts
    function initializeCharts(){
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
        });
        lineGraphOptions = {  low: 0,
            low: 0,
            showArea: true,
            height: '300px',
            axisY: {
                labelInterpolationFnc: function(value,idx) {
                    return formatter.format(value);     
                }
            },
            chartPadding: {
                left: 30
            },
            plugins: [
                Chartist.plugins.legend(),
                Chartist.plugins.tooltip()
            ],
        }

        barGraphOptions = {
            // Default mobile configuration
            height: '250px',
            axisY: {
              offset: 20
            },
            plugins: [
                Chartist.plugins.legend(),
                Chartist.plugins.tooltip()
            ],
            
        }

        barGraphMobileSettings = [
            // Options override for media > 400px
            ['screen and (min-width: 400px)', {
              reverseData: true,
              horizontalBars: true,
              axisX: {
                labelInterpolationFnc: Chartist.noop
              },
              axisY: {
                offset: 60
              }
            }],
            // Options override for media > 800px
            ['screen and (min-width: 800px)', {
              stackBars: false,
              seriesBarDistance: 10
            }],
            // Options override for media > 1000px
            ['screen and (min-width: 1000px)', {
              reverseData: false,
              horizontalBars: false,
              seriesBarDistance: 15
            }]
        ];
        
        // CHARTS - COUNT
        var currentUrl = window.location.href;
        $.get(currentUrl + "?search=&count=true",{
            from: $('input[name="from"]').val(),
            to: $('input[name="to"]').val(),
            group: $('select[name="group"]').val(),
            chart: $('input[name="chart"]').val()
        }).done(function(data){
            
            if(document.querySelector('.count-bets') != null){
                new Chartist.Bar('.count-bets',  
                data.chartBarNumber,barGraphOptions,barGraphMobileSettings);
            }
            if(document.querySelector('.sum-bets') != null){
                new Chartist.Line('.sum-bets',  
                data.chartBarAmount,lineGraphOptions);
            }
           
        });
     
    }
    
    // filter functions
    $(document).on('click','.btn-filter',function () {
        $('table[data-toggle="table"]').bootstrapTable('refresh');
        initializeCharts();

        let groupFilter = $('select[name="group"]').val();

        if(groupFilter == 'daily'){
            $('.div-chart').hide();
             $('.div-table').attr('class','col-xxl-12 col-lg-12  div-table');
        }else{
            $('.div-chart').show();
            $('.div-table').attr('class','col-xxl-6 col-lg-6  div-table');
        }

    }); 
   
});