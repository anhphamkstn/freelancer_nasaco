<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="admin-lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin-lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="admin-lte/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="/"><b>Nasaco</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <div>
                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control" placeholder="User name">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="repassword" type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="role-code" type="password" class="form-control" placeholder="Role code">
                    <span class="glyphicon glyphicon-compressed form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div>
                            <a href="/login" class="text-center">I already have a membership</a>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button onclick="register()" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </div>


        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <script src="js/jquery-3.2.0.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="admin-lte/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/notify.min.js"></script>
    <script src="js/login.js"></script>
    <script>
        function register() {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            let roleCode = $('#role-code').val();
            if(!(name&&email&&password&&roleCode)) {
                $.notify("Fill missing", {
                    globalPosition: 'bottom left',
                    className: 'error',
                });
                return;
            }
            if(password != repassword) {
                $.notify("Password does not match the confirm password", {
                    globalPosition: 'bottom left',
                    className: 'error',
                });
                return;
            }

            $.ajax({
                url: '/api/register',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    role_code: roleCode
                },
                success: function(data) {
                    $.notify("Success", {
                        globalPosition: 'bottom left',
                        className: 'success',
                    });
                    var login = new Login(email,password);
                    login.login(function(success,data){
                        if (success) {
                            localStorage.setItem("api_token", data.api_token);
                            location.replace('/');
                        } else {
                            $.notify("Error", {
                                globalPosition: 'bottom left',
                                className: 'error',
                            });
                        }
                    });
                },
                error: function(data) {
                    $.notify("Error", {
                        globalPosition: 'bottom left',
                        className: 'error',
                    });
                }
            });
        }
    </script>
</body>
</html>
