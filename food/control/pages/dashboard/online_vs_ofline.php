



          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Online & Offline Slaes</h3> 
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
                        <canvas id="pieonlineOfline" height="auto"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                   
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
               
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          
          
          
          
        <script>
    'use strict';
$(function () {
  
  //Simple implementation of direct chat contact pane toggle (TEMPORARY)
  $('[data-widget="chat-pane-toggle"]').click(function(){
    $("#myDirectChat").toggleClass('direct-chat-contacts-open');
  });

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
  var pieChartCanvas = $("#pieonlineOfline").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);

 let total_offline_sales=parseInt("<?php echo (float) $total_offline_sales; ?>");
 let total_online_sales=parseInt("<?php echo (float) $total_online_sales; ?>");

//  let expence=500;

  var PieData_sale = [
    {
      value: total_online_sales,
      color: "#00c0ef",
      highlight: "#00c0ef",
      label: "Online Sales"
    },
    {
      value: total_offline_sales,
      color: "#3c8dbc",
      highlight: "#3c8dbc",
      label: "Ofline Sales"
    }
  ];
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
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=label%> ₹<%=value %> "
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.  
  pieChart.Doughnut(PieData_sale, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------


});
</script>  
          