<div class="panel panel-default">
    <div class="panel-heading">Order Note

    </div>
    <div class="panel-body" style="padding-bottom: 0px;">
        <form method="post" action="index.php?orderid=<?php echo $order_id; ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="order_note" onkeyup="addNote(this.value);" placeholder="Note" value="<?php echo $get_order[0]['orddr_note']; ?>">
            </div>

        </form>
    </div>
</div>

<script>
 function addNote(note) {
        $.ajax({
            type: "POST",
            url: "add_note.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                noteData: note
            },
            success: function(result) {
                $("#somewhere").html(result);
            }
        });
    };
</script>