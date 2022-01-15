

<script>
    setTimeout(function(){ $('.alert').fadeOut() }, 5000);
    $(document).ready(function(){
    $('#mytable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ]
        });
        
        $('.buttons-excel').html('<span class="glyphicon glyphicon-copy" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5></span>  ');
        
        $('.buttons-pdf').html('<span class="glyphicon glyphicon-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5></span> ');
        
        $('.buttons-csv').html('<span class="glyphicon glyphicon-save-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5></span> ');
        
        $('.buttons-copy').html('<span class="glyphicon glyphicon-duplicate" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5></span> ');
        
        $('.buttons-print').html('<span class="glyphicon glyphicon-print" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5></span> ');
    });   
        
    $("#add_new").on("click", function(){
        var table_name = "<?php echo base64_encode($table_name)?>";
        var insert ="add";
        $.ajax({
            type: 'POST',
            data:{
              data: table_name,
              type:insert,
            },
            url: "../../src/security/generate_csrf.php", 
            success: function(result){
                $(".token_create").val(result);
            }
        });
        
      $('#table_list').hide(1000);
      $('#add_form').show(1000);
      $('select').chosen('destroy'); 
      $("select").chosen();
    });
    
    
    
    $("#back_add_form").on("click", function(){
      $('#table_list').show(1000);
      $('#add_form').hide(1000);
    });
    $("#back_edit_form").on("click", function(){
      $('#table_list').show(1000);
      $('#edit_panel').hide(1000);
    });
    $(".f_edit").click(function(){
        var table_name = "<?php echo base64_encode($table_name)?>";
        var insert ="update";
        $.ajax({
            type: 'POST',
            data:{
              data: table_name,
              type:insert,
            },
            url: "../../src/security/generate_csrf.php", 
            success: function(result){
                $(".token_update").val(result);
            }
        });
     var x = $(this).closest("#edit_form_data").serializeArray();
    //  console.log(x);
        $.each(x, function(i, field){
          if(field.name=='image'||field.name=='logo' || field.name=='img'||field.name=='images'){
            $("#src_"+field.name). attr("src", "<?php echo $table_name;?>_"+field.name+"/"+field.value);
            $("#f_old_"+field.name).val(field.value);
          }else{
            $("#f_"+field.name).val(field.value);
          }
        });
            $('#table_list').hide(1000);
            $('#edit_panel').show(1000);
            $('select').chosen('destroy'); 
            $("select").chosen();
  });
$(document).on('click', '#del_btn', function(e) {
e.preventDefault();
var y= $(this).closest(".del_form").serializeArray();
    var id=y[0].value;
swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover !",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $('#del_form_'+id).submit();
  }
});
}); 

$(document).on('click', '#update_btn', function(e) {
   $('#update_btn').html("<i class='fa fa-refresh fa-spin' ></i> Updating...");
});





</script>