<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
</style>
<div class="containe-fluid">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 p2">
                            	<div class="card bg-light">
	                            	<div class="card-body">
		                                <span class="float-right summary_icon"> <i class="fa fa-book text-muted "></i></span>
		                                <h4><b>
		                                    <?php echo $conn->query("SELECT * FROM books")->num_rows ?>
		                                </b></h4>
		                                <p><b>Total Books</b></p>
	                                </div>
                                </div>
                            </div>
                            <div class="col-md-4 p2">
                            	<div class="card bg-light">
	                            	<div class="card-body">
		                                <span class="float-right summary_icon"> <i class="fa fa-list-alt text-muted "></i></span>
		                                <h4><b>
		                                    <?php echo $conn->query("SELECT * FROM categories")->num_rows ?>
		                                </b></h4>
		                                <p><b>Total Categories</b></p>
	                                </div>
                                </div>
                            </div>
                            <div class="col-md-4 p2">
                            	<div class="card bg-light">
	                            	<div class="card-body">
		                                <span class="float-right summary_icon"> <i class="fa fa-th-list text-muted "></i></span>
		                                <h4><b>
		                                    <?php echo $conn->query("SELECT * FROM orders where status = 0")->num_rows ?>
		                                </b></h4>
		                                <p><b>Total Pending Orders</b></p>
	                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      			
        </div>
    </div>
</div>
