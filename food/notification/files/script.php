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
        
        $('.buttons-excel').html('<img class="img-responsive img_icon" src="files/images/xls.png" ><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5> ');
        
        $('.buttons-pdf').html('<img class="img-responsive img_icon" src="files/images/pdf.png" ><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5> ');
        
        $('.buttons-csv').html('<img class="img-responsive img_icon" src="files/images/csv.png" ><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5> ');
        
        $('.buttons-copy').html('<img class="img-responsive img_icon" src="files/images/copy.png" ><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5> ');
        
        $('.buttons-print').html('<img class="img-responsive img_icon" src="files/images/print.png" ><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5> ');
    });   
        
    $("#add_new").on("click", function(){
      $('#table_list').hide(1000);
      $('#add_form').show(1000);
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
     var x = $(this).closest("#edit_form_data").serializeArray();
     console.log(x);
        $.each(x, function(i, field){
            $("#f_"+field.name).val(field.value);
            });
            $('#table_list').hide(1000);
            $('#edit_panel').show(1000);
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
    swal("Deteted successfully", {
      icon: "success",
    });
    $('#del_form_'+id).submit();
  }
});
}); 

$(document).on('click', '#update_btn', function(e) {
   $('#update_btn').html("<i class='fa fa-refresh fa-spin' ></i> Updating...");
});
</script>