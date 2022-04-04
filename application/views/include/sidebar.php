<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/default.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('username'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a href="<?php echo base_url(); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->session->userdata('role') == 1) {
            ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>Master Data</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url(); ?>gejala"><i class="fa fa-database"></i> Master Gejala</a></li>
                        <li><a href="<?php echo base_url(); ?>penyakit"><i class="fa fa-database"></i> Master Penyakit</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>aturan">
                        <i class="fa fa-tree"></i> <span>Aturan</span>
                    </a>
                </li>
            <?php    } ?>


            <li>
                <a href="<?php echo base_url(); ?>konsultasi">
                    <i class="fa fa-stethoscope"></i> <span>Konsultasi</span>
                </a>
            </li>

            <?php if ($this->session->userdata('role') == 1) {
            ?>
                <li>
                    <a href="<?php echo base_url(); ?>rep_konsultasi">
                        <i class="fa fa-file-excel-o"></i> <span>Laporan Konsultasi</span>
                    </a>
                </li>
            <?php    } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script>
    let _menu = $('.sidebar-menu').find('a');
    for (var i = 0; i < _menu.length; i++) {
        href = _menu.eq(i).attr('href');
        if (window.location.href == href) {
            _menu.eq(i).parents('li').addClass('active');
            _menu.eq(i).parents('li').parents('li').addClass('active');
        }
    }
</script>