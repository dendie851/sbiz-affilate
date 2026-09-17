<?php include_once 'mainRead.php' ?>
<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">

<head>
    <title>HR - Mahira Global Nusantara</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="HR - Mahira Global Nusantara" />
    <meta name="keywords" content="HR - Mahira Global Nusantara">
    <meta name="author" content="Srthemesvilla" /> 
    <link rel="icon" type="image/x-icon" href="<?php echo $config['app']['assets'] ?>/img/favicon.png">

    <!-- Icon fonts --> 
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/fontawesome.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/ionicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/linearicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/open-iconic.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/bootstrap-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/shreerang-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>libs/datatables/datatables.css">  
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>libs/morris/morris.css">  
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>libs/select2/select2.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">  

    <style>
        .dt-button {

        }
    </style>
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->


    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
                <!-- Brand demo (see assets/css/demo/demo.css) -->
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <img src="<?php echo $config['app']['assets'] ?>img/logo-small.png" alt="logo" class="img-fluid">
                    </span>
                    <a href="#" class="app-brand-text demo sidenav-text font-weight-normal ml-2" ><b>Administrator</b></a>
                    <a href="#" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        <i class="fa fa-list-ul"></i>
                    </a>
                </div>
                <div class="sidenav-divider mt-0"></div>

                <!-- Links -->

                <div class="scrollbar" style=" overflow-y: auto; scrollbar-width: thin;">
                    <ul class="sidenav-inner py-1 ">
                        <!-- Dashboards -->
                        <li class="sidenav-item <?php echo $globalModulActive == 'home' ? 'active' : '' ?>" id="grupMenuDashboard">
                            <a href="<?php echo $globalUrl ?>home/dashboard" class="sidenav-link">
                                <i class="sidenav-icon fa fa-home"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'home' ? 'color:white; font-weight: bold' : '' ?>">Dashboard</div>
                            </a>
                        </li>    

                        <?php if(in_array('1',$_SESSION['loginInfo']['moduleAccess'])): ?>
                        <li class="sidenav-item <?php echo in_array($globalModulActive, array('company','managementUser')) ? 'open' : '' ?>">
                            <a href="javascript:" class="sidenav-link sidenav-toggle">
                                <i class="sidenav-icon fa fa-cog"></i>&nbsp;
                                <div style="<?php echo in_array($globalModulActive, array('company','managementUser')) > 0 ? 'color:white; font-weight: bold' : '' ?>">Pengaturan Umum </div>
                            </a>
                            <ul class="sidenav-menu">
                                <li class="sidenav-item <?php echo $globalModulActive == 'company' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>company/edit" class="sidenav-link">
                                        <div>Profil Perusahaan</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'managementUser' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>managementUser/index" class="sidenav-link">
                                        <div>Manajemen User</div>
                                    </a>
                                </li>                        
                            </ul>                        
                        </li>  
                        <?php endif; ?>  

                        <li class="sidenav-item <?php echo substr_count($globalModulActive, 'employee') > 0 ? 'open' : '' ?>">
                            <a href="javascript:" class="sidenav-link sidenav-toggle">
                                <i class="sidenav-icon fa fa-user-friends"></i>&nbsp;
                                <div style="<?php echo substr_count($globalModulActive, 'employee') > 0 ? 'color:white; font-weight: bold' : '' ?>">Karyawan </div>
                            </a>
                             <ul class="sidenav-menu">
                                <li class="sidenav-item <?php echo $globalModulActive == 'employeeDepartement' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>departement/index" class="sidenav-link">
                                        <div>Departemen</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'employeePosition' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>employeePosition/index" class="sidenav-link">
                                        <div>Posisi</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'employeeStatus' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>employeeStatus/index" class="sidenav-link">
                                        <div>Status Pekerja</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'employee' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>employee/index" class="sidenav-link">
                                        <div>Karyawan</div>
                                    </a>
                                </li>                        
                            </ul>                        
                        </li>    
                        <li class="sidenav-item <?php echo $globalModulActive == 'absen' ? 'active' : '' ?>">
                            <a href="<?php echo $globalUrl ?>absen/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-clipboard-check"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'absen' ? 'color:white; font-weight: bold' : '' ?>">Daftar Absen</div>
                            </a>
                        </li>    


                        <li class="sidenav-divider mb-1"></li>
                        <li class="sidenav-header small font-weight-semibold" id="grupMenupayroll">Penggajian & Intensif</li>

                        <li class="sidenav-item <?php echo in_array($globalModulActive, array('payrollMonthComponentIn','payrollMonthComponentOut')) ? 'open' : '' ?>">
                            <a href="javascript:" class="sidenav-link sidenav-toggle">
                                <i class="sidenav-icon fa fa-weight"></i>&nbsp;
                                <div style="<?php echo in_array($globalModulActive, array('payrollMonthComponentIn','payrollMonthComponentOut')) > 0 ? 'color:white; font-weight: bold' : '' ?>">Pengaturan Slip Gaji</div>
                            </a>
                            <ul class="sidenav-menu">
                                <li class="sidenav-item <?php echo $globalModulActive == 'payrollMonthComponentIn' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>payrollMonthComponentIn/index" class="sidenav-link">
                                        <div>Komponen Pendapatan</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'payrollMonthComponentOut' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>payrollMonthComponentOut/index" class="sidenav-link">
                                        <div>Komponen Pengurangan</div>
                                    </a>
                                </li>                        
                            </ul>                        
                        </li>    


                        <li class="sidenav-item <?php echo $globalModulActive == 'payrollMonthComponentList' ? 'active' : '' ?>">
                            <a href="<?php echo $globalUrl ?>payrollMonthComponentList/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-address-book"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'payrollMonthList' ? 'color:white; font-weight: bold; font-size: 13px' : '' ?>">Penerima Gaji & Insentif</div>
                            </a>
                        </li>    

                        <li class="sidenav-item <?php echo $globalModulActive == 'payrollInsentifPayment' ? 'active' : '' ?>">
                            <a href="<?php echo $globalUrl ?>payrollInsentifPayment/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-money-bill"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'payrollInsentifPayment' ? 'color:white; font-weight: bold' : '' ?>">Pembayaran Insentif</div>
                            </a>
                        </li>    

                        <li class="sidenav-item <?php echo $globalModulActive == 'payrollMonthPayment' ? 'active' : '' ?>">
                            <a href="<?php echo $globalUrl ?>payrollMonthPayment/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-money-bill-alt"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'payrollMonthPayment' ? 'color:white; font-weight: bold' : '' ?>">Pembayaran Gaji</div>
                            </a>
                        </li>    

                        <li class="sidenav-item <?php echo in_array($globalModulActive, array('reportPayrollMonth','reportInsentif')) ? 'open' : '' ?>">
                            <a href="javascript:" class="sidenav-link sidenav-toggle">
                                <i class="sidenav-icon fa fa-chart-bar"></i>&nbsp;
                                <div style="<?php echo in_array($globalModulActive, array('reportPayrollMonth','reportInsentif')) > 0 ? 'color:white; font-weight: bold' : '' ?>">Laporan</div>
                            </a>
                            <ul class="sidenav-menu">
                                <li class="sidenav-item <?php echo $globalModulActive == 'reportPayrollMonth' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>reportPayrollMonth/index" class="sidenav-link">
                                        <div>Laporan Penggajian</div>
                                    </a>
                                </li>                        
                                <li class="sidenav-item <?php echo $globalModulActive == 'reportInsentif' ? 'active' : '' ?>">
                                    <a href="<?php echo $globalUrl ?>reportInsentif/index" class="sidenav-link">
                                        <div>Laporan Insentif</div>
                                    </a>
                                </li>                        
                            </ul>                        
                        </li>    

                        <li class="sidenav-divider mb-1"></li>
                        <li class="sidenav-header small font-weight-semibold" id="grupMenuAsset">Pengelolaan Asset</li>

                        <li class="sidenav-item <?php echo $globalModulActive == 'assetCategory' ? 'active' : '' ?>">
                            <a href="<?php echo $globalUrl ?>assetCategory/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-cubes"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'assetCategory' ? 'color:white; font-weight: bold' : '' ?>">Kategori Asset</div>
                            </a>
                        </li>    

                        <li class="sidenav-item <?php echo $globalModulActive == 'asset' ? 'active' : '' ?>" >
                            <a href="<?php echo $globalUrl ?>asset/index" class="sidenav-link">
                                <i class="sidenav-icon fa fa-cube"></i>&nbsp;
                                <div style="<?php echo $globalModulActive == 'asset' ? 'color:white; font-weight: bold' : '' ?>">Asset & Peminjaman</div>
                            </a>
                        </li>                        
                    </ul>
                </div>    
            </div>
            <!-- [ Layout sidenav ] End -->
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

                    <!-- Brand demo (see assets/css/demo/demo.css) -->
                    <a href="#" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
                        <span class="app-brand-logo demo">
                            <img src="<?php echo $config['app']['assets'] ?>img/logo-small.png" alt="Logo" class="img-fluid">
                        </span>
                        <span class="app-brand-text demo font-weight-normal ml-2"><b>Administrator</b></span>
                    </a>

                    <!-- Sidenav toggle (see assets/css/demo/demo.css) -->
                    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
                        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:">
                            <i class="fa fa-list-ul text-large align-middle"></i>
                        </a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
                        <!-- Divider -->
                        <hr class="d-lg-none w-100 my-2">

                        <div class="navbar-nav align-items-lg-center">
                            <!-- Search -->
                            <form action="<?php $globalUrl ?>product/index" method="post">                                                              
                                 <label class="nav-item navbar-text navbar-search-box p-0 active">
                                    <i class="fa fa-search  navbar-icon align-middle"></i>
                                    <span class="navbar-search-input pl-2">
                                      <input name="keyword" type="text" class="form-control navbar-text mx-2" placeholder="Cari Produk" value="<?php echo isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '' ?>">
                                    </span>
                                </label>
                            </form>
                        </div>
                        <div class="navbar-nav align-items-lg-center ml-auto">
                            <!-- Divider -->
                            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>
                            <div class="demo-navbar-user nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                                        <i class="fa fa-user-shield d-block" style="font-size: 20px; border: 1px solid #ccc; border-radius: 5px; padding: 5px"></i>
                                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0"><?php echo isset($_SESSION['loginInfo']['name']) ? $_SESSION['loginInfo']['name'] : ''; ?></span>
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo $globalUrl ?>changePassword/edit" class="dropdown-item">
                                        <i class="fa fa-key"></i> &nbsp; Ubah Password
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo $globalUrl ?>auth/sigout" class="dropdown-item">
                                        <i class="fa fa-power-off" style="color: red"></i> &nbsp; Log Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>  
                </nav>
                <!-- [ Layout navbar ( Header ) ] End -->

                <!-- [ Layout content ] Start -->
                <div class="layout-content">
					<?php echo $templateContent ?>
                </div>

                
                <!-- [ Layout content ] Start -->

            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper] End -->


    <!-- Core scripts -->
    <script src="<?php echo $config['app']['assets'] ?>js/pace.js"></script>

    <!--    
    <script src="<?php echo $config['app']['assets'] ?>js/jquery-3.3.1.min.js"></script>
    -->
    <script src="<?php echo $config['app']['assets'] ?>js/jquery-3.4.1.min.js"></script>


    <script src="<?php echo $config['app']['assets'] ?>libs/popper/popper.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/bootstrap.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/sidenav.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/layout-helpers.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/material-ripple.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/demo.js"></script>

    <!-- Lib -->
    <script src="<?php echo $config['app']['assets'] ?>libs/datatables/datatables.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/bootbox/bootbox.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/chart-am4/core.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/chart-am4/charts.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/chart-am4/animated.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/eve/eve.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/flot/flot.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/flot/curvedLines.js"></script>

    <script src="<?php echo $config['app']['assets'] ?>libs/raphael/raphael.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/morris/morris.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/select2/select2.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

    <?php if(isset($globalViewScroolGroupMenu)): ?>
        <script type="text/javascript">       
            var viewScroolGroupMenu = '<?php echo $globalViewScroolGroupMenu ?>';
            document.getElementById(viewScroolGroupMenu).scrollIntoView(); 
        </script>
    <?php endif; ?>    
     
    <script type="text/javascript">
        $('.listMenu').perfectScrollbar();
    </script>    
    <?php echo isset($embedCssJS) ? $embedCssJS : '' ?>
</body>

</html>
