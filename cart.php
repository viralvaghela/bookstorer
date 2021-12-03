<?php include 'admin/db_connect.php' ?>
<style type="text/css">
	.img-field{
		width: calc(25%);
		max-height: 25vh;
		overflow: hidden;
		display: flex;
		justify-content: center
	}
	.detail-field{
		width: calc(50%);
	}
	.amount-field{
		width: calc(25%);
		text-align:right;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.img-field img{
		max-width: 100%;
		max-height: 100%;
	}
	.qty-input{
		width: 75px;
		text-align: center; 
	}

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
</style>
<div class="container-fluid m-3">	
	<div class="col-lg-10 offset-md-1">
    <?php 
    $qry = $conn->query("SELECT c.*,b.image_path,b.title,b.author FROM cart c inner join books b on b.id = c.book_id where c.customer_id ={$_SESSION['login_id']}");
    $total = 0;
    ?>
    <div class="row">
    <div class="col-md-8">
    	<?php if($qry->num_rows > 0): ?>
    		<ul class="list-group">
    			<?php 
    			while($row= $qry->fetch_array()):
    				$total += $row['qty']*$row['price'];
    			?>
    			<li class="list-group-item" data-id="<?php echo $row['id'] ?>" data-price="<?php echo $row['price'] ?>">
    				<div class="d-flex w-100">
    					<div class="img-field mr-4 img-thumbnail rounded">
    						<img src="admin/assets/uploads/<?php echo $row['image_path'] ?>"  alt="" class="img-fluid rounded">
    					</div>
    					<div class="detail-field">
    						<p>Book: <b><?php echo $row['title'] ?></b></p>
    						<p>Author: <b><?php echo $row['author'] ?></b></p>
    						<p>Price: <b><?php echo number_format($row['price'],2) ?></b></p>
    						<div class="d-flex col-sm-5">
					            <span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span>
					            <input type="number" name="qty" id="" class="form-control form-control-sm qty-input" value="<?php echo $row['qty'] ?>">
					            <span class="btn btn-sm btn-secondary btn-plus"><b><i class="fa fa-plus"></i></b></span>
					        </div>
    					</div>
    					<div class="amount-field">
    						<b class="amount"><?php echo number_format($row['qty']*$row['price'],2) ?></b>
    					</div>
    				<span class="float-right"><button class="btn btn-sm btn-outline-danger rem_item" type="button"  data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button></span>
    				</div>
    			</li>
    		<?php endwhile; ?>
    		</ul>
    	<?php else: ?>
    		<center><b>No Item</b></center>
    	<?php endif; ?>
    </div>
    <div class="col-md-4">
    	<div class="card mb-4">
    		<div class="card-header bg-primary text-white"><b>Total Amount</b></div>
    		<div class="card-body">
    			<h4 class="text-right"><b id="tamount"><?php echo number_format($total,2) ?></b></h4>
    		</div>
    	</div>
    	<button class="btn btn-block btn-primary" id="checkout" type="button">Checkout</button>
    </div>
</div>
</div>
</div>
<script>
	$('.btn-minus').click(function(){
		start_load()
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
            var input = $(this).siblings('input')
            var id = $(this).closest('li').attr('data-id')
            $.ajax({
            	url:'admin/ajax.php?action=update_cart',
            	method:'POST',
            	data:{id:id,qty:qty},
            	success:function(resp){
            		if(resp == 1){
                		input.val(qty).trigger('change')
                		calc()
            			end_load()
            		}
            	}
            })
     })
     $('.btn-plus').click(function(){
		start_load()
        var qty = $(this).siblings('input').val()
            qty = parseInt(qty) + 1;
        var input = $(this).siblings('input')
        var id = $(this).closest('li').attr('data-id')
        $.ajax({
        	url:'admin/ajax.php?action=update_cart',
        	method:'POST',
        	data:{id:id,qty:qty},
        	success:function(resp){
        		if(resp == 1){
            		input.val(qty).trigger('change')
            		calc()
        			end_load()
        		}
        	}
        })
     })
     function calc(){
     	$('.qty-input').each(function(){
     		var li = $(this).closest('li')
     		var price = li.attr('data-price')
     		var qty = $(this).val()
     		var amount = parseFloat(qty) * parseFloat(price);
     		li.find('.amount').text(parseFloat(amount).toLocaleString('en-US',{style:"decimal",maximumFractionDigits:2,minimumFractionDigits:2}))
     	})
     	var total = 0;
     	$('.amount').each(function(){
     		var amount = $(this).text()
     			amount = amount.replace(/,/g,'');
     			total += parseFloat(amount)
     	})
     	$('#tamount').text(parseFloat(total).toLocaleString('en-US',{style:"decimal",maximumFractionDigits:2,minimumFractionDigits:2}))
     }
     $('.rem_item').click(function(){
     	_conf("Are you sure to remove this item from cart?","delete_cart",[$(this).attr('data-id')])
     })
     function delete_cart($id){
     	start_load()
     	$.ajax({
        	url:'admin/ajax.php?action=delete_cart',
        	method:'POST',
        	data:{id:$id},
        	success:function(resp){
        		if(resp == 1){
            		alert_toast("Item removed from cart","success");
        			setTimeout(function(){ location.reload() },750)
        		}
        	}
        })
     }
     $('#checkout').click(function(){
     	uni_modal('Chechkout',"manage_order.php");
     })
</script>
