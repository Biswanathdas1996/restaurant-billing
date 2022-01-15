



          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
               
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-user"></span></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Customer Data</span>
                      <span class="info-box-number" id="total_stock">..</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
           
            </div>
           
            <div class="clearfix visible-sm-block"></div>

           
           
            
            
          </div><!-- /.row -->
          
          
          <script>
              $.ajax('api_total_customer.php',   // request url
                    {
                        success: function (data, status, xhr) {// success callback function
                            var responce =JSON.parse(data);
                            
                            $("#total_stock").html(responce);
                    }
                });
          </script>