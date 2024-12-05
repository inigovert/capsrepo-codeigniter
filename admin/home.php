<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <!-- Card 1 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Department List</h5>
                <i class="fas fa-th-list fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `department_list` WHERE status = 1")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Curriculum List</h5>
                <i class="fas fa-scroll fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `curriculum_list` WHERE `status` = 1")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Verified Students</h5>
                <i class="fas fa-user-check fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `student_list` WHERE `status` = 1")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <!-- Card 4 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Not Verified Students</h5>
                <i class="fas fa-user-times fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `student_list` WHERE `status` = 0")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <!-- Card 5 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Verified Archives</h5>
                <i class="fas fa-archive fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `archive_list` WHERE `status` = 1")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
    <!-- Card 6 -->
    <div class="col-12 col-sm-6 mb-4">
        <div class="card shadow h-100">
            <div class="ic-DashboardCard__header_hero d-flex align-items-center justify-content-between px-3" style="background-color: #00773C; height: 5rem;">
                <h5 class="text-white">Not Verified Archives</h5>
                <i class="fas fa-archive fa-2x text-white"></i>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Total: 
                    <strong>
                        <?php echo $conn->query("SELECT * FROM `archive_list` WHERE `status` = 0")->num_rows; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
</div>
