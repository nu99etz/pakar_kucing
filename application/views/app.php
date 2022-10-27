<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pakar Penyakit Gigi</title>
    <?php $this->load->view('include/header'); ?>
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <header class="main-header">
            <?php $this->load->view('include/navbar'); ?>
        </header>
        <!-- /.navbar -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <?php $this->load->view('include/sidebar'); ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php $this->load->view($view, $data); ?>
        </div>

        <?php $this->load->view('include/footer'); ?>

    </div>

</body>

</html>