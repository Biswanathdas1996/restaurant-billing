<?php

        $final_graphData_payment_method= json_encode($graphData_payment_method);

?>


                        <div class="chart-responsive" style="margin-top: 20px;text-align: center;">
                            <!-- Sales Chart Canvas -->
                            <canvas id="pieChartSalespaymenthod_paymemt_type" height="200px"></canvas>
                        </div><!-- /.chart-responsive -->
           




<script>
    'use strict';
    $(function() {

        

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //-----------------------
        //- MONTHLY SALES CHART -
        //-----------------------




        //---------------------------
        //- END MONTHLY SALES CHART -
        //---------------------------

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChartSalespaymenthod_paymemt_type").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);

        
        let graphData_payment_method =<?php echo $final_graphData_payment_method?>;
        // let graphData_payment_method =[{"payment_method":null,"total":517.12},{"payment_method":"Debit Card","total":7176.5},{"payment_method":"Credit Card","total":3479.75},{"payment_method":"swiggy","total":735},{"payment_method":"phpnepe","total":202.95}];

        // console.log("graphData_payment_method",graphData_payment_method)
        //  let expence=500;

        // var PieData_sale = [{
        //         value: 12,
        //         color: "#f56954",
        //         highlight: "#f56954",
        //         label: "Total Expance"
        //     },
        //     {
        //         value: 12,
        //         color: "#00a65a",
        //         highlight: "#00a65a",
        //         label: "Sales"
        //     }
        // ];
        var PieData_sale_payment_method = [];
        let colorArray= ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de"]

        graphData_payment_method.map((val,index)=>{
            let temp_arry={};
            if(index < colorArray.length){
            temp_arry={
                value: val.total,
                color: colorArray[index],
                highlight: colorArray[index],
                label: val.payment_method
            }
            }else{
             temp_arry={
                value: val.total,
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: val.payment_method
            }
        }
            
            PieData_sale_payment_method.push(temp_arry);
        })


        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: false,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            //String - A tooltip template
            tooltipTemplate: "<%=label%> ₹<%=value %> "
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.  
        pieChart.Doughnut(PieData_sale_payment_method, pieOptions);
        //-----------------
        //- END PIE CHART -
        //-----------------


    });
</script>