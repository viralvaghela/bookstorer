<?php include 'admin/db_connect.php' ?>
<?php
session_start();
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM books where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
if(!empty($category_ids))
$cat_qry = $conn->query("SELECT * FROM categories where id in ($category_ids)");
$cname = array();
while($row=$cat_qry->fetch_array()){
    $cname[$row['id']] = ucwords($row['name']);
}
}
?>
<style type="text/css">
	
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    #qty{
        width: 50px;
        text-align: center
    }
</style>
<div class="container-fluid">
	<img src="admin/assets/uploads/<?php echo $image_path ?>" class="d-flex w-100" alt="">
	<p>Title: <large><b><?php echo $title ?></b></large></p>
    <p>Author: <b><?php echo $author ?></b></p>
	<p>Category: <b>
    <?php 
      $cats = '';
      $cat = explode(',', $category_ids);
      foreach ($cat as $key => $value) {
        if(!empty($cats)){
          $cats .=", ";
        }
        if(isset($cname[$value])){
          $cats .= $cname[$value];
        }
      }
      echo $cats;
      ?>
    </b></p>
    <p>Price: <b><?php echo number_format($price,2) ?></b></p>
	<p>Description:</p>
	<p class=""><small><i><?php echo $description ?></i></small></p>
	<div class="d-flex jusctify-content-center col-md-12">
        <div class="d-flex col-sm-5">
            <span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span>
            <input type="number" name="qty" id="qty" value="1">
            <span class="btn btn-sm btn-secondary btn-plus"><b><i class="fa fa-plus"></i></b></span>
        </div>
		<button class="btn btn-primary btn-block btn-sm col-sm-4" type="button" id="add_to_cart">Add to Cart</button>
	</div>
</div>
<script>
    $('.btn-minus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
                $(this).siblings('input').val(qty).trigger('change')
         })
     $('.btn-plus').click(function(){
        var qty = $(this).siblings('input').val()
            qty = parseInt(qty) + 1;
            $(this).siblings('input').val(qty).trigger('change')
     })
// $('#manage_bid')
$('#add_to_cart').click(function(){
    if('<?php echo !isset($_SESSION['login_id']) ?>' == 1){
            uni_modal("Please Login First",'login.php')
            return false
    }
    start_load()

    $.ajax({
        url:'admin/ajax.php?action=add_to_cart',
        method:'POST',
        data:{book_id: '<?php echo $id ?>',price: '<?php echo $price ?>', qty:$('#qty').val()},
        success:function(resp){
            if(resp == 1){
                alert_toast("Book successfully added to cart.","success")
                end_load()
                load_cart()
            }
        }
    })
})	
   
</script>
