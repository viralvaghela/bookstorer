<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

	
    ?>

    <style>
      #main-field{
        margin-top: 5rem!important;
      }
      .cart-img {
          width: calc(20%);
          height: 13vh;
          padding: 3px
      }
      .cart-img img{
        width: 100%;
        height: 100%;
      }
      .cart-qty {
        font-size: 14px
      }
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>


                        <li class="nav-item dropdown">
                          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                            <div class="badge badge-danger cart-count">0</div>
                            <i class="fa fa-shopping-cart"></i>
                            <span>Cart</span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:25vw">
                            <div class="cart-list w-100" id="cart_product">
                            
                              
                            </div>
                            
                            <div class="d-flex bg-light justify-content-center w-100 p-2">
                                <a href="index.php?page=cart" class="btn btn-sm btn-primary btn-block col-sm-4 text-white"><i class="fa fa-edit"></i>  View Cart</a>
                            </div>
                          </div>
                          </li>
                      <?php endif; ?>
                          
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                       <div class=" dropdown mr-4">
                            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
                              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                                <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                              </div>
                        </div>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
                      <?php endif; ?>
                       
                        
                     
                    </ul>
                </div>
            </div>
        </nav>
  <main id="main-field">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
       
</main>
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class=" py-5 bg-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
           
        </footer>
        
       <?php include('footer.php') ?>
    </body>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#manage_my_account').click(function(){
          uni_modal("Manage Account",'signup.php');
      })
    </script>
    <?php $conn->close() ?>

</html>
