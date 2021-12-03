<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>order List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<colgroup>
								<col width="5%">
								<col width="15%">
								<col width="20%">
								<col width="20%">
								<col width="15%">
								<col width="15%">
								<col width="10%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Date</th>
									<th class="text-center">Customer</th>
									<th class="text-center">Items</th>
									<th class="text-center">Total Amount</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$orders = $conn->query("SELECT o.*,c.name FROM orders o inner join customers c on c.id = o.customer_id order by unix_timestamp(o.date_created) asc ");
								while($row=$orders->fetch_assoc()):
									$tamount = $conn->query("SELECT sum(price * qty) as amount from order_list where order_id = ".$row['id'])->fetch_array()['amount'];
									$items = $conn->query("SELECT sum(qty) as items from order_list where order_id = ".$row['id'])->fetch_array()['items'];
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo date("M d,Y",strtotime($row['date_created'])) ?></b></p>
									</td>
									<td class="">
										<p><b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="text-center">
										<p><b><?php echo $items ?></b></p>
									</td>
									<td class="">
										<p class="text-right"><b><?php echo number_format($tamount,2) ?></b></p>
									</td>
									<td class="text-center">
										<?php if($row['status'] == 0): ?>
											<span class="badge badge-primary">Pending</span>
										<?php elseif($row['status'] == 1): ?>
											<span class="badge badge-success">Confirmed</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_order" type="button" data-id="<?php echo $row['id'] ?>">View</button>
										<button class="btn btn-sm btn-danger delete_order" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
	.img{
		max-height: 15vh;
	}
	/*.img img{
		max
	}*/
</style>
<script>
	$('#new_order').click(function(){
		uni_modal("New order","manage_order.php","large")
	})
	$('.edit_order').click(function(){
		uni_modal("Manage order Data","manage_order.php?id="+$(this).attr('data-id'),"large")
	})
	$('#manage-order').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#manage-order').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_order',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.delete_order').click(function(){
		_conf("Are you sure to delete this order?","delete_order",[$(this).attr('data-id')])
	})
	function delete_order($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_order',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>