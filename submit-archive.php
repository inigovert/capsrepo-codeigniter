<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * FROM `archive_list` WHERE id = '{$_GET['id']}'");
    if($qry->num_rows){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k)) $$k = $v;
        }
    }
    if(isset($student_id) && $student_id != $_settings->userdata('id')){
        echo "<script> alert('You don\'t have access to this page'); location.replace('./'); </script>";
    }
}
?>
<style>
    .banner-img {
        object-fit: scale-down;
        object-position: center center;
        height: 30vh;
        width: calc(100%);
    }
</style>
<div class="content py-4">
    <div class="card card-outline card-warning shadow rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title"><b><?= isset($id) ? "Update Archive - {$archive_code} Details" : "Submit Project" ?></b></h5>
        </div>
        <div class="card-body rounded-0">
            <div class="container-fluid">
                <form action="" id="archive-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title" class="control-label text-navy">Capstone Project Title</label>
                                <input type="text" name="title" id="title" autofocus placeholder="Project Title" class="form-control form-control-border" value="<?= isset($title) ? $title : "" ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="year" class="control-label text-navy">Year</label>
                                <select name="year" id="year" class="form-control form-control-border" required>
                                    <?php 
                                    for($i = 0; $i < 51; $i++):
                                        $year_val = date("Y", strtotime(date("Y") . " -{$i} years"));
                                    ?>
                                    <option value="<?= $year_val ?>" <?= isset($year) && $year == $year_val ? "selected" : "" ?>><?= $year_val ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="abstract" class="control-label text-navy">Abstract</label>
                                <textarea rows="3" name="abstract" id="abstract" placeholder="Enter abstract" class="form-control form-control-border summernote" required><?= isset($abstract) ? html_entity_decode($abstract) : "" ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="members" class="control-label text-navy">Project Members</label>
                                <textarea rows="3" name="members" id="members" placeholder="Enter project members" class="form-control form-control-border summernote" required><?= isset($members) ? html_entity_decode($members) : "" ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="img" class="control-label text-muted">Project Image/Banner Image</label>
                                <input type="file" id="img" name="img" class="form-control form-control-border" accept="image/png,image/jpeg" onchange="displayImg(this, $(this))" <?= !isset($id) ? "required" : "" ?>>
                            </div>
                            <div class="form-group text-center">
                                <img src="<?= validate_image(isset($banner_path) ? $banner_path : "") ?>" alt="Project Banner" id="cimg" class="img-fluid banner-img bg-gradient-dark border">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!--  Video Teaser Upload                                                                                                                                                          --->
                        <div class="form-group">
                            <label for="video" class="control-label text-muted">Project Video Teaser (MP4 Only)</label>
                            <input type="file" id="video" name="video" class="form-control form-control-border" accept="video/mp4" <?= !isset($id) ? "required" : "" ?>>
                        </div>
                        <div class="form-group text-center">
                            <?php if (isset($video_path) && !empty($video_path)): ?>
                                <video controls width="100%" class="mt-2">
                                    <source src="<?= validate_video($video_path) ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else: ?>
                                <p class="text-muted">No video uploaded yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="pdf" class="control-label text-muted">Project Document (PDF Only)</label>
                                <input type="file" id="pdf" name="pdf" class="form-control form-control-border" accept="application/pdf" <?= !isset($id) ? "required" : "" ?>>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-default bg-success btn-flat">Submit</button>
                            <a href="./?page=profile" class="btn btn-light border btn-flat">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#cimg').attr('src', "<?= validate_image(isset($banner_path) ? $banner_path : '') ?>");
        }
    }

    $(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['undo', 'redo']]
            ]
        });

        $('#archive-form').submit(function(e) {
            e.preventDefault();
            start_loader();
            $(".pop-msg").remove();
            const _this = $(this);
            const msgEl = $("<div>").addClass("alert pop-msg my-2").hide();

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_archive",
                data: new FormData(_this[0]),
                method: 'POST',
                contentType: false,
                processData: false,
                dataType: 'json',
                error: err => {
                    console.error(err);
                    msgEl.text("An error occurred while saving the data").addClass("alert-danger");
                    _this.prepend(msgEl.show('slow'));
                    end_loader();
                },
                success: function(resp) {
                    if (resp.status === 'success') {
                        location.href = "./?page=view_archive&id=" + resp.id;
                    } else {
                        msgEl.text(resp.msg || "An unknown error occurred").addClass("alert-danger");
                        _this.prepend(msgEl.show('slow'));
                    }
                    end_loader();
                }
            });
        });
    });
</script>
