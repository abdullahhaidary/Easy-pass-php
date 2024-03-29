<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="adminResource/plugins/fontawesome-free/css/all.min.css"> -->
    <!-- IonIcons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="adminResource/dist/css/adminlte.min.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/select2.min.js"></script>
<script src="adminResource/plugins/jquery/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- <link rel="stylesheet" href="../adminResource/plugin/css/select2.min.css"> -->
    <?php echo isset($additionalStyles) ? $additionalStyles : ''; ?>
    <?php echo isset($additionalUpperScripts) ? $additionalUpperScripts : ''; ?>
    <style>
        .select2-container .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff; /* Change the background color */
    color: #fff; /* Change the text color */
    border: 1px solid #204d74; /* Change the border color */
}

/* Hover state */
.select2-container .select2-selection--multiple .select2-selection__choice:hover {
    background-color: #007bff; /* Change the background color on hover */
    color: #fff; /* Change the text color on hover */
    cursor:pointer;
    border: 1px solid #204d74; /* Change the border color on hover */
}
    </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="adminResource/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="adminResource/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="adminResource/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="adminResource/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="adminResource/dist/img/abdullah.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="dashboard.php" class="d-block">Abdullah Haidary</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
<!--                                                <ul class="nav nav-treeview">-->
<!--                                                    <li class="nav-item">-->
<!--                                                        <a href="./index.html" class="nav-link">-->
<!--                                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                                            <p>Dashboard v1</p>-->
<!--                                                        </a>-->
<!--                                                    </li>-->
<!--                                                    <li class="nav-item">-->
<!--                                                        <a href="./index2.html" class="nav-link">-->
<!--                                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                                            <p>Dashboard v2</p>-->
<!--                                                        </a>-->
<!--                                                    </li>-->
<!--                                                    <li class="nav-item">-->
<!--                                                        <a href="./index3.html" class="nav-link active">-->
<!--                                                            <i class="far fa-circle nav-icon"></i>-->
<!--                                                            <p>Dashboard v3</p>-->
<!--                                                        </a>-->
<!--                                                    </li>-->
<!--                                                </ul>-->
                    </li>
                    <li class="nav-item">
                        <a href="dashboard_search.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_search.php' ? 'active' : ''; ?>">
                            <i class="fa fa-search nav-icon"></i>
                            <p>Dashboard Search</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-file-excel"></i>
                            <p>
                                Download Excel File
                                <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="excel/exporttoexcell_absent.php"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Export Absents</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="excel/exporttoexcell.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Export Distributed</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="excel/export_all_data.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Export All Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="excel/export_remain.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Export All Finger Issues</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="Users_Report.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Users_Report.php' ? 'active' : ''; ?>">
                            <i class="fa fa-file nav-icon"></i>
                            <p>User Reports</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Location_Selection.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'Location_Selection.php' ? 'active' : ''; ?> nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Location Selection</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="home.php" class="nav-link">
                            <i class="fa fa-home nav-icon"></i>
                            <p>Go To HOME</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="fa fa-sign-out-alt nav-icon"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
