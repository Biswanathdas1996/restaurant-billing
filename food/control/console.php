<?php

include("../db/connection.php");

$actual_link=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

$sql = "SHOW TABLES FROM $dbname";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
$data=[];
while ($row = mysqli_fetch_row($result)) {
    $data[]=$row[0];
}
mysqli_close($conn);
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<style>
    .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-logo{
    position: relative;
    margin-left: -41.5%;
}
.login-logo img{
    position: absolute;
    width: 20%;
    margin-top: 19%;
    background: #282726;
    border-radius: 4.5rem;
    padding: 5%;
}
.login-form-1{
    padding: 4%;
    background:#282726;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    margin-bottom:12%;
    color:#fff;
}
.login-form-2{
    padding: 4%;
    background: #3c8dbc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    margin-bottom:12%;
    color: #fff;
}
.btnSubmit{
    font-weight: 600;
    width: 50%;
    color: #282726;
    background-color: #fff;
    border: none;
    border-radius: .25rem;
    padding:2%;
}
.btnForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.btnForgetPwd:hover{
    text-decoration:none;
    color:#fff;
}
.chosen-container-single .chosen-single {
    position: relative;
    display: block;
    overflow: hidden;
    padding: 0 0 0 8px;
    height: 25px;
    border: 1px solid 
#aaa;
border-radius: 5px;
background-color: #fff;
background: -webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#fff),color-stop(50%,#f6f6f6),color-stop(52%,#eee),color-stop(100%,#f4f4f4));
background: -webkit-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
background: -moz-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
background: -o-linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
background: linear-gradient(top,#fff 20%,#f6f6f6 50%,#eee 52%,#f4f4f4 100%);
background-clip: padding-box;
box-shadow: 0 0 3px
#fff inset,0 1px 1px
rgba(0,0,0,.1);
color:
#444;
text-decoration: none;
white-space: nowrap;
line-height: 34px;
border-radius: .25rem !important;
min-height: 38px !important;
background:
    white !important;
}
.chosen-container-single .chosen-single div {
    position: absolute;
    top: 7px;
    right: 0;
    display: block;
    width: 18px;
    height: 100%;
}
</style>
<div class="container login-container">
            <div class="row">
                 <div class="col-md-2 "></div>
                <div class="col-md-4 login-form-1">
                    <div style="min-height: 100px;"> 
                    <h3 style="font-size: 24px;">Create Page with DB Table</h3>
                    </div>
                    <form autocomplete="off" class="idForm">
                        <div class="form-group">
                            
                            <select class="form-control" id="dbtable" name="table" required>
                                <option></option>
                                <?php foreach($data as $val){?>
                                <option><?php echo $val;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter page name *" value="" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Create Page" />
                        </div>
                        <div class="form-group">
                           
                        </div>
                    </form>
                </div>
                <div class="col-md-4 login-form-2">
                    <form autocomplete="off" class="idForm">
                    <div style="min-height: 100px;">    
                    <h3 style="font-size: 24px;">Create Blank Page</h3>
                    </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="blank_name" placeholder="Enter page name *" value="" />
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Create Page" />
                        </div>
                        <div class="form-group">

                            
                        </div>
                    </form>
                </div>
                <div class="col-md-2 "></div>
            </div>
        </div>
        
        
        <script>
            $(document).ready(function(){
              //Chosen
              $("#dbtable").chosen();
            });
            
        $(".idForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var link="<?= $actual_link ?>"
        $.ajax({
               type: "POST",
               url: "console_ajax.php",
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                                              
                       swal("Page created successfully!  What do you want to do?", {
                              icon: "success",
                              buttons: {
                                cancel: "Stay here!",
                                catch: {
                                  text: "Go to the page",
                                  value: "catch",
                                },
                                
                              },
                            })
                            .then((value) => {
                              switch (value) {
                             
                                case "catch":
                                  window.location.replace(link+"/"+data);
                                  break;
                             
                                default:
                                  
                              }
                            });
                            
                            
                
                  
               }
             });
        });
            
            
            
        </script>
        