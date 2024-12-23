<style>
/* Change the sidebar background color to FEU green */
.main-sidebar {
    background-color: #009700 !important; /* FEU green */
}

/* Adjust the color of the sidebar links */
.nav-sidebar > .nav-item > .nav-link {
    color: white !important; /* White text for links */
}

.nav-sidebar > .nav-item > .nav-link.active {
    background-color: #006b00 !important; /* Slightly darker green for active links */
    color: white !important; /* White text for active links */
}

/* Update the brand logo background */
.brand-link {
    background-color: #008800 !important; /* Slightly darker green for branding */
    color: white !important; /* White text for the logo */
}

/* Adjust hover effect for links */
.nav-sidebar > .nav-item > .nav-link:hover {
    background-color: #007700 !important; /* Medium green hover effect */
}
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link text-sm shadow-sm">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black" style="width: 1.8rem; height: 1.8rem; max-height: unset; object-fit: scale-down; object-position: center center;">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="clearfix"></div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-4">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item dropdown">
                                <a href="./" class="nav-link nav-home">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=archives" class="nav-link nav-archives">
                                    <i class="nav-icon fas fa-archive"></i>
                                    <p>Archives List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url ?>admin/?page=students" class="nav-link nav-students">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Student List</p>
                                </a>
                            </li>
                            <?php if ($_settings->userdata('type') == 1): ?>
                            <li class="nav-header">Maintenance</li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=departments" class="nav-link nav-departments">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p>Department List</p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=curriculum" class="nav-link nav-curriculum">
                                    <i class="nav-icon fas fa-scroll"></i>
                                    <p>Curriculum List</p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>User List</p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
