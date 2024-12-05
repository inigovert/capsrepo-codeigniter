<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition ">
  <script>
    start_loader()
  </script>
  <style>
    html, body{
      height:calc(100%) !important;
      width:calc(100%) !important;
    }
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover1')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
    }
    .login-title{
      text-shadow: 2px 2px black
    }
    /* #login{
      flex-direction:column !important
    } */
    #login{
        direction:rtl
    }
    #login > *{
        direction:ltr
    }
    #logo-img{
        height:150px;
        width:150px;
        object-fit:scale-down;
        object-position:center center;
        border-radius:100%;
    }
    /* #login .col-7,#login .col-5{
      width: 100% !important;
      max-width:unset !important
    } */

    .bg-green {
    background-color: #009900 !important;
}
  </style>
<div class="h-100 d-flex  align-items-center w-100" id="login">
    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
      <div class="w-100">
        <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
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
      </div>
      
    </div>

    <div class="col-5 h-100 bg-gradient bg-green"> 
    <div class="w-100 d-flex justify-content-center align-items-center h-100 text-dark"> 
            <div class="card card-outline card-warning rounded-0 shadow col-lg-10 col-md-10 col-sm-5">
                <div class="card-header">
                    <h5 class="card-title text-center text-dark"><b>Registration</b></h5>
                </div>
                <div class="card-body">
                    <form action="" id="registration-form">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="firstname" id="firstname" autofocus placeholder="Firstname" class="form-control form-control-border" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="middlename" id="middlename" placeholder="Middlename (optional)" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" class="form-control form-control-border" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-auto">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="genderMale" name="gender" value="Male" required checked>
                                    <label for="genderMale" class="custom-control-label">Male</label>
                                </div>
                            </div>
                            <div class="form-group col-auto">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="genderFemale" name="gender" value="Female">
                                    <label for="genderFemale" class="custom-control-label">Female</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <span class="text-navy"><small>Department</small></span>
            <select name="department_id" id="department_id" class="form-control form-control-border select2" data-placeholder="Select Department" required>
                <option value="" disabled selected>Select Department</option> <!-- Updated Placeholder -->
                <?php 
                $department = $conn->query("SELECT * FROM department_list where status = 1 order by name asc");
                while($row = $department->fetch_assoc()):
                ?>
                <option value="<?= $row['id'] ?>"><?= ucwords($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
</div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <span class="text-navy"><small>Curriculum</small></span>
                                    <select name="curriculum_id" id="curriculum_id" class="form-control form-control-border select2" data-placeholder="" required>
                                        <option value="" disabled selected>Select Deparment First</option>
                                        <?php 
                                        $curriculum = $conn->query("SELECT * FROM curriculum_list where status = 1 order by name asc");
                                        $cur_arr = [];
                                        while($row = $curriculum->fetch_assoc()){
                                            $row['name'] = ucwords($row['name']);
                                            $cur_arr[$row['department_id']][] = $row;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control form-control-border" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-border" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" id="cpassword" placeholder="Confirm Password" class="form-control form-control-border" required>
                                </div>
                            </div>
                        </div>

                    <!-- Submit Button -->
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group text-right">
                                <button class="btn btn-default btn-flat" style="background-color: #A7CA3B; color: white;"> Register</button> 
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3">
    <!-- Link to the homepage -->
    <div class="mb-2">
        <a href="<?= base_url ?>" class="text-decoration-none text-success fw-bold">
            <i class="fa fa-home"></i> Go to Website
        </a>
    </div>

    <!-- Link to the login page -->
    <small class="text-muted">
        Already have an account? 
        <a href="login.php" class="text-decoration-none text-primary fw-bold">Login</a>
    </small>
</div>

            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

<script>
    var cur_arr = $.parseJSON('<?= json_encode($cur_arr) ?>');
  $(document).ready(function(){
    end_loader();
    $('.select2').select2({
        width:"100%"
    })
    $('#department_id').change(function(){
        var did = $(this).val()
        $('#curriculum_id').html("")
        if(!!cur_arr[did]){
            Object.keys(cur_arr[did]).map(k=>{
                var opt = $("<option>")
                    opt.attr('value',cur_arr[did][k].id)
                    opt.text(cur_arr[did][k].name)
                $('#curriculum_id').append(opt)
            })
        }
        $('#curriculum_id').trigger("change")
    })

    // Registration Form Submit
    $('#registration-form').submit(function(e){
        e.preventDefault()
        var _this = $(this)
            $(".pop-msg").remove()
            $('#password, #cpassword').removeClass("is-invalid")
        var el = $("<div>")
            el.addClass("alert pop-msg my-2")
            el.hide()
        if($("#password").val() != $("#cpassword").val()){
            el.addClass("alert-danger")
            el.text("Password does not match.")
            $('#password, #cpassword').addClass("is-invalid")
            $('#cpassword').after(el)
            el.show('slow')
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Users.php?f=save_student",
            method:'POST',
            data:_this.serialize(),
            dataType:'json',
            error:err=>{
                console.log(err)
                el.text("An error occured while saving the data")
                el.addClass("alert-danger")
                _this.prepend(el)
                el.show('slow')
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.href= "./login.php"
                }else if(!!resp.msg){
                    el.text(resp.msg)
                    el.addClass("alert-danger")
                    _this.prepend(el)
                    el.show('show')
                }else{
                    el.text("An error occured while saving the data")
                    el.addClass("alert-danger")
                    _this.prepend(el)
                    el.show('show')
                }
                end_loader();
                $('html, body').animate({scrollTop: 0},'fast')
            }
        })
    })
  })
</script>
</body>
</html>