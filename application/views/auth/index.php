<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?>">PAKAR DENTAL</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>

            <form id="form-login" action="<?php echo $action; ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                    </div>
                    <div class="col-xs-4"></div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box -->
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });

            $('#form-login').on('submit', function() {
                event.preventDefault();
                let _data = new FormData($(this)[0]);

                $(document).on('submit', 'form#form-login', function() {
                    event.preventDefault();
                    let _url = $(this).attr('action');
                    let _data = new FormData($(this)[0]);
                    send((data, xhr = null) => {
                        if (data.status == 422) {
                            FailedNotif(data.messages);
                        } else if (data.status == 200) {
                            Swal.fire({
                                type: 'success',
                                title: "Login Sukses",
                                text: data.messages,
                                timer: 3000,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = data.url;
                            });
                        }
                    }, _url, 'json', 'post', _data);
                });
            });
        </script>


</body>

</html>