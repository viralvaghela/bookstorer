<?php include "db_connect.php" ?>
<?php 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM books where id = ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-book">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
					<b class="text-muted">Book Informations</b>
			<div class="row">
				<div class="col-md-6 border-right">
					<div class="form-group">
						<label class="label control-label">Title</label>
						<input type="text" class="form-control form-control-sm w-100" name="title" required="" value="<?php echo isset($title) ? $title : '' ?>">
					</div>
					<div class="form-group">
						<label class="label control-label">Author</label>
						<input type="text" class="form-control form-control-sm w-100" name="author" required="" value="<?php echo isset($author) ? $author : '' ?>">
					</div>
					<div class="form-group">
						<label class="label control-label">Description</label>
						<textarea name="description" id="" cols="30" rows="3" class="form-control" required=""><?php echo isset($description) ? $description : '' ?></textarea>
					</div>
					<div class="form-group">
						<label class="label control-label">Category</label>
						<select name="category_ids[]" id="" class="custom-select custom-select-sm select2" required multiple="multiple">
							<option value=""></option>
							<?php
							$categories = $conn->query("SELECT * FROM categories order by name asc");
							while($row= $categories->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($category_ids) && !empty($category_ids) &&  in_array($row['id'],explode(',',$category_ids)) ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
						<?php endwhile; ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="label control-label">Price</label>
						<input type="text" class="form-control form-control-sm w-100 text-right number text-right" name="price" required="" value="<?php echo isset($price) ? $price : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Image</label>
						<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
					</div>
					<div class="form-group">
						<img src="<?php echo isset($row['image_path']) ? 'assets/uploads/'.$row['image_path'] :'' ?>" alt="" id="cimg">
					</div>
					<div id="msg" class="form-group"></div>
				</div>
			</div>
		</div>

	</form>
</div>
<style>
	img#cimg{
		max-height: 10vh;
		max-width: 6vw;
	}

</style>
<script>
	$('.select2').select2({
		placeholder:"Please Select Here",
		width:'100%'
	})
	$('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/,/g,'') 
        val = val > 0 ? val : 0;
        $(this).val(parseFloat(val).toLocaleString("en-US"))
    })
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-book').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_book',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.reload()
					},750)
				}
			}
		})
	})
</script>