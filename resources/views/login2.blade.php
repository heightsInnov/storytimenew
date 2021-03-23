<!doctype html>
<html lang="en">

    <head>
        <title>Story Time</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper ">
            <div class="main-panel">
                <!-- your content here -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">Login</h4>
                                    </div>
                                    <div class="card-body">
                                        @include('errors.list')
                                        <form action="{{ route('user_login') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Username</label>
                                                        <input name="email" id="login_email" type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Password</label>
                                                        <input name="password" id="login_password" type="password" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div><br/>
                                            <a href="{{route('register_user')}}">Register</a>
                                            <button name="submit" type="submit" class="btn btn-primary pull-right">Sign In</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright float-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                        <!-- your footer here -->
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
