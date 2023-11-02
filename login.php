<?php
if(isset($_REQUEST['login'])){
    $password= mysql_real_escape_string(trim(md5($_REQUEST['password']))); //mengambil nilai password (untuk kemanan login)
    $us = mysql_real_escape_string(trim($_REQUEST['username']));

    $az=mysql_query("select IDUser, IDLevel from tbluser where Username = '$us' and Password = '$password' limit 1");
    if(mysql_num_rows($az)==1){
        $a=mysql_fetch_array($az);

        $_SESSION[level]=$a[IDLevel];
        $_SESSION[id]=$a[IDUser];
        echo "<meta http-equiv='refresh'content='0;url=index.php'> ";
        exit;
    }else{
      ?>
      <script type="text/javascript">alert("Username dan password salah !!!\nSilahkan coba lagi...");
      </script>
      <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login | SHRI | Sensus Harian Rawat Inap</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="icon" href="assets/img/logo/logo5.jpg"/>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="assets/css/default/style.min.css" rel="stylesheet" />
    <link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-blue">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed" align="center">
            <!-- begin right-content -->
            <div class="center-content col-md-4" style="background-color: white;margin-top: 100px;">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <img src="assets/img/logo/logo5.jpg" width="100" height="100">
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form method="POST">
                                <fieldset>
                                    <div class="form-group row m-b-15">
                                        <label class="col-md-3 col-form-label">Username</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-15">
                                        <label class="col-md-3 col-form-label">Password</label>
                                        <div class="col-md-7">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-7 offset-md-3">
                                            <button type="submit" class="btn btn-sm btn-primary m-r-5" name="login">Login</button>
                                            <button type="reset" class="btn btn-sm btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                    <hr />
                    <div class="m-t-20 p-lg text-center">
                        <span>&copy;</span>
                        <span>2023</span>
                        <span>-</span>
                        <span>SHRI</span>
                        <br>
                        <span>Sensus Harian Rawat Inap</span>
                    </div>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/js-cookie/js.cookie.js"></script>
    <script src="assets/js/theme/default.min.js"></script>
    <script src="assets/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>

