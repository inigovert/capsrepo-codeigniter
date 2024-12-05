<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>
<body class="hold-transition">
<script>
    start_loader();
</script>
<style>
    html, body {
        height: calc(100%) !important;
        width: calc(100%) !important;
    }

    body {
        background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
        background-size: cover;
        background-repeat: no-repeat;
    }

    #login {
        display: flex;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    #logo-img {
        height: 150px;
        width: 150px;
        object-fit: scale-down;
        border-radius: 50%;
    }

    .bg-green {
        background-color: #009900 !important;
    }

    .btn-login {
        background-color: #A7CA3B;
        color: white;
    }
</style>
<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success');
    </script>
<?php endif; ?>

<div id="login">
    <div class="col-5 bg-gradient bg-green">
        <div class="card card-outline card-warning shadow">
            <div class="card-header text-center">
                <h4 class="text-dark"><b>Login</b></h4>
            </div>
        <div class="card-body">
            <form id="slogin-form" action="" method="post">
                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!-- Login Button -->
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-login btn-block">Login</button>
                    </div>
                </div>
            </form>
            <!-- Links -->
            <div class="text-center mt-3">
                <a href="<?= base_url ?>" class="text-success">
                    <i class="fa fa-home"></i> Go to Website
                </a>
                <br>
                <small class="text-muted">Don't have an account yet?
                    <a href="register.php" class="text-primary">Register Now!</a>
                </small>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function () {
        end_loader();
        // Login Form Submission
        $('#slogin-form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $(".pop-msg").remove();
            let alertDiv = $("<div>").addClass("alert pop-msg my-2").hide();

            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Login.php?f=student_login",
                method: 'POST',
                data: form.serialize(),
                dataType: 'json',
                error: function (err) {
                    console.error(err);
                    alertDiv.text("An error occurred while logging in.").addClass("alert-danger");
                    form.prepend(alertDiv);
                    alertDiv.show('slow');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status === 'success') {
                        location.href = "./";
                    } else {
                        alertDiv.text(resp.msg || "Invalid credentials. Please try again.").addClass("alert-danger");
                        form.prepend(alertDiv);
                        alertDiv.show('slow');
                        end_loader();
                    }
                }
            });
        });
    });
</script>
</body>
</html>
