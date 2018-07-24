<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/font-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<div class="col-md-offset-1 col-md-10">	
	<table id="subcategory-table">
		<thead>
			<tr>
				<td>Category Name</td>
				<td>Sub-Category Name</td>
				<td>Description</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="http://localhost/ci/ci_pms/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="http://localhost/ci/ci_pms/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#subcategory-table').DataTable({
			"pageLength" : 10,
			"ajax": {
				url : "subcategories_data",
				type : 'GET',
			},
			
		});
	});
</script>
</html>
