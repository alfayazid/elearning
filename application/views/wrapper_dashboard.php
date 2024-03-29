<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Elearning</title>

    <!-- Core CSS - Include with every page -->
    <link href="<? echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<? echo base_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="<? echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<? echo base_url('index.php/rest_client/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->


            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <?    
                            if($this->session->userdata('logged_in')!="" && $this->session->userdata('level')=="Admin")
                            { ?>
                            <li>
                                <a href="<? echo base_url('index.php/rest_client/list_user'); ?>"><i class="fa fa-users fa-fw"></i> List User</a>
                            </li>
                            <li>
                                   <a href="<? echo base_url('index.php/rest_client/tampil_matkul'); ?>"><i class="fa fa-book fa-fw"></i> Mata Kuliah</a>
                            </li>
                            <? }

                            if($this->session->userdata('logged_in')!="" && $this->session->userdata('level')=="Dosen")
                            { ?>
                            
                            <li>
                                   <a href="<? echo base_url('index.php/rest_client/tampil_matkul_dosen'); ?>"><i class="fa fa-book fa-fw"></i> Mata Kuliah</a>
                            </li>

                            <? }

                        ?>

                        

                        

                        
                        
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <? echo $output ?>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<? echo base_url('assets/js/jquery-1.10.2.js'); ?>"></script>
    <script src="<? echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<? echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<? echo base_url('assets/js/sb-admin.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
