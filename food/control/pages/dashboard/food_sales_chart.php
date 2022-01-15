<?php


$get_all_category = select("food_category");
$totalData = [];

  $sql = "SELECT * FROM food_order_item GROUP BY item_id ORDER BY qnt DESC LIMIT 30 ";

$retval = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($retval)) {
  $nestedData = [];
  $get_item = select("food_demo", [
    "conditions" => [
      "id" => $row['item_id']
    ]
  ]);
  $nestedData[] = "<img class='img-responsive' src='../addNewFood/food_demo_img/".$get_item[0]["img"] . "' style='width: 50px;height: 50px;'> ";
  $nestedData[] = $get_item[0]["title"];
  $get_all_ordered_item = select("food_order_item", [
    "conditions" => [
      "item_id" => $row['item_id']
    ]
  ]);
  $qnt = 0;
  foreach ($get_all_ordered_item as $data) {
    $qnt += $data["qnt"];
  }
  $nestedData[] = $qnt;
  $totalData[] = $nestedData;
}

$lebel = [];
    $dataLebel = [];
 foreach ($totalData as $data) { 
    $lebel[] = substr($data[1],0,20);
    $dataLebel[] = $data[2];

 }

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Item Sales</h3>
                <div class="box-tools pull-right">


                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">
                            <!--<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>-->
                        </p>
                        <div class="chart-responsive">
                            <!-- Sales Chart Canvas -->
                            <canvas id="datasalesChartFood" height="500"></canvas>
                            <!-- <canvas id="pieChart" height="180"></canvas> -->
                        </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- ./box-body -->

        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->




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
        var salesChartCanvas = $("#datasalesChartFood").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);


        var level_array_sales = <?php echo json_encode($lebel); ?>;
        var dataGraph_sales = <?php echo json_encode($dataLebel); ?>;

        var salesChartData = {
            labels: level_array_sales,
            datasets: [{
                label: "Sales",
                fillColor: "#c21500",
                strokeColor: "#c21500",
                pointColor: "#3b8bba",
                pointStrokeColor: "#c21500",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#c21500",
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
            maintainAspectRatio: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,

        };

        //Create the line chart
        salesChart.Bar(salesChartData, salesChartOptions);




    });
</script>