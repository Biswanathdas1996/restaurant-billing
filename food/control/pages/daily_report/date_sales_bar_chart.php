<?php
$sql = "SELECT * FROM food_order WHERE `food_order`.`date` between '$sdate'
 AND '$edate' GROUP BY `food_order`.`date`";



$retval = mysqli_query($conn, $sql);
if (mysqli_num_rows($retval) > 0) {
    $graphData = [];
    $head["date"] = "Opening Move";
    $head["totals"] = "Percentage";
    $graphData[] = $head;
    $lebel = [];
    $dataLebel = [];
    while ($row = mysqli_fetch_assoc($retval)) {
        $temp = [];
        $temp_date = $row['date'];
        $sqlSum = mysqli_query($conn, "SELECT SUM(`food_order`.`total`) as totals FROM food_order WHERE `food_order`.`date` = '$temp_date'");
        $rowSum = mysqli_fetch_array($sqlSum);
        $temp["date"] = $row['date'];
        $temp['totals'] = (float) $rowSum['totals'];
        $graphData[] = $temp;

        $lebel[] = $row['date'];
        $dataLebel[] = (float) $rowSum['totals'];
    }
} else {
    echo "0 results";
}
// pr($dataLebel);
?>

       
           
         
                        <div class="chart-responsive">
                            <!-- Sales Chart Canvas -->
                            <canvas id="datasalesChart" height="400" width="900"></canvas>
                            <!-- <canvas id="pieChart" height="180"></canvas> -->
                        </div><!-- /.chart-responsive -->
                    
 




<script>
    'use strict';
    $(function() {

        //Simple implementation of direct chat contact pane toggle (TEMPORARY)
        $('[data-widget="chat-pane-toggle"]').click(function() {
            $("#myDirectChat").toggleClass('direct-chat-contacts-open');
        });

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //-----------------------
        //- MONTHLY SALES CHART -
        //-----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $("#datasalesChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

    

        var level_array_sales = <?php echo json_encode($lebel); ?>;
        var dataGraph_sales = <?php echo json_encode($dataLebel); ?>;

        var salesChartData = {
            labels: level_array_sales,
            datasets: [{
                label: "Sales",
                fillColor: "#2980b9",
                strokeColor: "#2980b9",
                pointColor: "#3b8bba",
                pointStrokeColor: "#2980b9",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#2980b9",
                barThickness: 10,
                maxBarThickness: 10,
                data: dataGraph_sales
            }]
        };

        var salesChartOptions = {
            barThickness: 40,
            maxBarThickness: 40,
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: true,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: false,

        };

        //Create the line chart
        salesChart.Bar(salesChartData, salesChartOptions);




    });
</script>