<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <i class="fa fa-home" aria-hidden="true" style="margin-top: 15px;"></i>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Nasaco</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/avatar.png" class="user-image" alt="User Image">
                        <span id="user-name" class="hidden-xs">Administrator</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="img/avatar.png" class="img-circle" alt="User Image">
                            <p>
                                <span id="name">Guest</span>
                                <small id="role-name">Administrator</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div style="width: 100%; text-align: center;">
                                <a onclick="signOut()" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

@push('scripts')
    <script type="text/javascript">
        $(function(){
            axios.get('/api/user',{
                params: { api_token: localStorage['api_token']}
            }).then(e => {
                var data = e.data;
                $('#user-name').html(data.email);
                $('#name').html(data.name);
                if(data.roles.length > 0) {
                    $('#role-name').html(data.roles[0].display_name);
                }
            }).catch(e => {
                console.log(e);
            })
        });

        function signOut() {
            axios.post('/api/logout',{
                params: {
                    api_token: localStorage['api_token']
                }
            })
            .then(e => {
                location.replace('/');
            }).catch(e => {
                console.log(e);
            })
        }
    </script>
@endpush