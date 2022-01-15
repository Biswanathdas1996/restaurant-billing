
    <script src="<?php echo getenv('HTTP_BASE_PATH');?>food/control/src/files/cdn/jquery.min.js"></script>
  <script src="<?php echo getenv('HTTP_BASE_PATH');?>food/control/src/files/cdn/bootstrap.min.js"></script>
  
      <script type="text/javascript">
      
        $(".toggleForms").click(function() {
            
            $("#signUpForm").toggle();
            $("#logInForm").toggle();
            
            
        });
          
          $('#diary').bind('input propertychange', function() {

                $.ajax({
                  method: "POST",
                  url: "updatedatabase.php",
                  data: { content: $("#diary").val() }
                });

        });
      
      
      </script>
      
  </body>
</html>


