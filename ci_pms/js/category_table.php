<script type="text/javascript">
$(document).ready(function()
{

/* $('#example').DataTable({
 "pageLength" : 5,
    "ajax": {
            url : "<?php //echo base_url('call/categories_table')?>",
            type : 'GET'
        },
    });*/
$('#example').DataTable({
        "pageLength" : 5,
        "ajax": {
            url : "call/categories_table",
            type : 'GET'
        },
    });

});
</script>