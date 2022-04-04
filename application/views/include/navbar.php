<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<body class="hold-transition skin-blue-light sidebar-mini">
    <!--  -->
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>F</b>C</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Forward Chainning</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <!-- Sidebar toggle button-->


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- Notifications: style can be found in dropdown.less -->

                        <!-- Tasks: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url(); ?>assets/default.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url(); ?>assets/default.png" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $this->session->userdata('username'); ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="row">
                                        <div class="col-xs-4"></div>
                                        <div class="col-xs-4">
                                            <a href="#" id="logout" class="btn btn-default btn-flat">Keluar</a>
                                        </div>
                                        <div class="col-xs-4"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>

        <script>
            $('#logout').click(function() {
                Swal.fire({
                    title: 'Apakah Anda Yakin Keluar Dari Sistem ?',
                    showCancelButton: true,
                    confirmButtonText: `Logout`,
                    confirmButtonColor: '#d33',
                    icon: 'question'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: "GET",
                            url: "<?php echo base_url(); ?>" + "auth/doLogout",
                            dataType: "json",
                            success: function(data) {
                                if (data.status == 200) {
                                    Swal.fire({
                                        type: 'success',
                                        title: "Logout Sukses",
                                        text: data.messages,
                                        timer: 3000,
                                        icon: 'success',
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    }).then(function() {
                                        window.location.href = data.url;
                                    });
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                toastr.error("Error" + eval(error));
                            }
                        })
                    }
                })
            });
        </script>

        <!-- =============================================== -->