<script>
  $(document).ready(function(){
    $('.list-group').each(function(){
      if(String($(this).text()).trim() == ""){
        $(this).html("")
      }
    })
    
    window.viewer_modal = function($src = ''){
      start_loader()
      var t = $src.split('.')
      t = t[1]
      if(t =='mp4'){
        var view = $("<video src='"+$src+"' controls autoplay></video>")
      }else{
        var view = $("<img src='"+$src+"' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
              show:true,
              backdrop:'static',
              keyboard:false,
              focus:true
            })
            end_loader()  
    }

    window.uni_modal = function($title = '' , $url='',$size=""){
        start_loader()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                    }else{
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                    }
                    $('#uni_modal').modal({
                      show:true,
                      backdrop:'static',
                      keyboard:false,
                      focus:true
                    })
                    end_loader()
                }
            }
        })
    }

    window._conf = function($msg='',$func='',$params = []){
       $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
       $('#confirm_modal .modal-body').html($msg)
       $('#confirm_modal').modal('show')
    }
  })
</script>

<footer class="main-footer text-sm" style="background-color: #0B3612; color: white; padding: 20px 0;">
  <div class="container">
      <div class="row align-items-center">
          <!-- Left Section -->
          <div class="col-lg-9 col-md-6">
              <a href="https://www.feutech.edu.ph/">
                  <img src="https://www.feutech.edu.ph/assets/img/pages/footlogo.png" alt="FEU Tech Logo" class="img-fluid mb-3" width="386px" height="67">
              </a>
              <p style="margin: 0;">
                  <strong>Address:</strong> P. Paredes St., Sampaloc, Manila 1015<br>
                  <strong>Trunkline:</strong> (02) 8281 88881<br>
              </p>
              <p>
                  <a style="color: white;" href="https://www.feutech.edu.ph/terms-and-conditions">Terms and Conditions</a> |
                  <a style="color: white;" href="https://www.feutech.edu.ph/privacy-policy">Privacy Policy</a> |
                  <a style="color: white;" href="https://www.feutech.edu.ph/faqs">FAQs</a> |
                  <a style="color: white;" href="https://www.feutech.edu.ph/contact">Contact Us</a>
              </p>
          </div>

          <!-- Right Section -->
          <div class="col-lg-3 col-md-6 text-center">
              <img src="https://www.feutech.edu.ph/assets/img/pages/dpo_seal.png" alt="DPO Seal" class="img-fluid" id="dpo_seal" style="max-width: 200px;">
          </div>
      </div>
      <div class="row">
          <!-- <div class="col-12 text-center mt-3">
            <strong>Copyright © <?php echo date('Y') ?>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
              <b><?php echo $_settings->info('short_name') ?> (by: <a href="https://www.feutech.edu.ph/" target="blank">ATMR x DevOps</a> )</b> v1.69
            </div>
          </div> -->
      </div>
  </div>
</footer>
<div id="libraries">
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- overlayScrollbars -->
  <!-- <script src="<?php echo base_url ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
  <!-- AdminLTE App -->
  <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
</div>
<div class="daterangepicker ltr show-ranges opensright">
  <div class="ranges">
    <ul>
      <li data-range-key="Today">Today</li>
      <li data-range-key="Yesterday">Yesterday</li>
      <li data-range-key="Last 7 Days">Last 7 Days</li>
      <li data-range-key="Last 30 Days">Last 30 Days</li>
      <li data-range-key="This Month">This Month</li>
      <li data-range-key="Last Month">Last Month</li>
      <li data-range-key="Custom Range">Custom Range</li>
    </ul>
  </div>
  <div class="drp-calendar left">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-calendar right">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div>
</div>
<div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>
<script>
  $(function(){
    $('.wrapper>.content-wrapper').css("min-height",$(window).height() - $('#top-Nav').height() - $('#login-nav').height() - $("footer.main-footer").height())
  })
</script>
