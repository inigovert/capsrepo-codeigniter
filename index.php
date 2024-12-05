<?php require_once('./config.php'); ?>
 <!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Condensed:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
<style>
  
  #header .site-title {
    font-family: 'Montserrat', sans-serif; /* Use the desired font */
    font-weight: 700; /* Adjust font weight */
    font-size: 3rem; /* Adjust size as needed */
    color: #FDB813;
    text-align: center;
}

  #header{
    height:70vh;
    width:calc(100%);
    position:relative;
    top:-1em;
  }
  #header:before{
    content:"";
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    background-image:url(<?= validate_image($_settings->info("cover")) ?>);
    background-size:cover;
    background-repeat:no-repeat;
    background-position: center center;
  }
  #header>div{
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    z-index:2;
  }

  #top-Nav a.nav-link.active {
      color: #001f3f;
      font-weight: 900;
      position: relative;
  }
  #top-Nav a.nav-link.active:before {
    content: "";
    position: absolute;
    border-bottom: 2px solid #001f3f;
    width: 33.33%;
    left: 33.33%;
    bottom: 0;
  }

  #enrollment {
    background-color: #009900;
    color: white;
    border: none;
}

#enrollment:hover {
    background-color: #007a00; /* Darker green on hover */
    color: white;
}

</style>
<?php require_once('inc/header.php') ?>
  <body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
    <div class="wrapper">
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php require_once('inc/topBarNav.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
      <?php endif;?>    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-5" style="">
        <?php if($page == "home" || $page == "about_us"): ?>
          <div id="header" class="shadow mb-4">
              <div class="d-flex justify-content-center h-100 w-100 align-items-center flex-column px-3">

           <h1 style="
    font-family: 'Montserrat', sans-serif; 
    font-weight: 700; 
    font-size: 4.5rem; 
    color: #FDB813; 
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); 
    text-align: center; 
    width: 100%; 
    margin: 0 auto; 
    line-height: 1.2;">
    FEU Institute of Technology: <br>Capstone Project Repository
</h1>

<br>
<a href="./?page=projects" 
   class="btn btn-lg rounded-pill w-25" 
   id="enrollment">
   <b>Explore Projects</b>
</a>


              </div>
          </div>
        <?php endif; ?>
        <!-- Main content -->
        <section class="content ">
          <div class="container">
            <?php 
              if(!file_exists($page.".php") && !is_dir($page)){
                  include '404.html';
              }else{
                if(is_dir($page))
                  include $page.'/index.php';
                else
                  include $page.'.php';

              }
            ?>
          </div>
        </section>
        <!-- /.content -->
        <div class="col-lg-8 mx-auto py-5">
    <div class="container-fluid">
        <div class="card card-outline card-warning shadow rounded-0">
            <div class="card-body rounded-0 p-4">
                <div class="container-fluid">
                    <h1 class="text-center mb-4">
                        <b>Welcome to the FEU Tech Capstone Project Repository!</b>
                    </h1>
                    <hr>
                    <div class="welcome-content">
                        <div class="welcome-section text-center py-3">
                            <p style="text-align: justify; margin: 0px 0px 15px; padding: 0px;">
                                At the <b>Far Eastern University - Institute of Technology</b>, we celebrate the ingenuity, creativity, and technical expertise of our students. This repository serves as a platform to showcase the remarkable capstone and research projects developed by FEU Tech students, spanning a diverse range of disciplines.
                            </p>
                            <p style="text-align: justify; margin: 0px 0px 15px; padding: 0px;">
                                Discover innovative solutions, cutting-edge technology, and pioneering research crafted by our talented minds. These projects reflect our commitment to academic excellence, technological advancement, and real-world problem-solving.
                            </p>
                            <p style="text-align: justify; margin: 0px 0px 15px; padding: 0px;">
                                Browse through the repository to explore projects that highlight the spirit of <b>Innovation and Excellence</b> at FEU Tech. Together, we build a future driven by knowledge and passion.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
