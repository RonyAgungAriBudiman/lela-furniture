  <?php
  session_start();
  include_once "sqlLib.php";
  $sqlLib = new sqlLib();

  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

  if (isset($_POST["signin"])) {

    $userid = $_POST["userid"];
    $password = $_POST["password"];
    $password = substr(md5($password), 1, 11);

    $sqluser = "SELECT UserID FROM ms_user WHERE UserID ='" . $userid . "' AND Aktif ='1' ";
    //echo $sqluser;
    $datauser = $sqlLib->select($sqluser);
    if (count($datauser) > 0) {
      $sqlpass = "SELECT a.UserID, a.Nama, a.Level, a.Image
                  FROM ms_user a 
                  WHERE  a.UserID ='" . $userid . "' AND  a.Password = '" . $password . "' ";
      $datapass = $sqlLib->select($sqlpass);
      if (count($datapass) > 0) {

        $_SESSION["userid"] = $datapass[0]["UserID"];
        $_SESSION["nama"]   = $datapass[0]["Nama"];
        $_SESSION["level"]  = $datapass[0]["Level"];
        $_SESSION["image"]  = $datapass[0]["Image"];
        
        setcookie("userid", $datapass[0]["UserID"], time() + (3600 * 24 * 30 * 12));
        setcookie("nama", $datapass[0]["Nama"], time() + (3600 * 24 * 30 * 12));
        setcookie("level", $datapass[0]["Level"], time() + (3600 * 24 * 30 * 12));
        setcookie("image", $datapass[0]["Image"], time() + (3600 * 24 * 30 * 12));
        header("location:index.php");
      } else {
        $alert = 1;
        $note  = "Userid atau password salah!!";
      }
    } else {

      $alert = 1;
      $note  = "UserID tidak ditemukan/tidak aktif!!";
    }


    
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>LELA FURNITURE</title>

    <!-- Favicon -->
    <!-- <link rel="icon" type="image/png" href="images/favicon.png"> -->

    <!-- General CSS Files -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
  </head>

  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="login-brand">
                <!-- <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                LELA FURNITURE
              </div>

              <?php
              if ($alert == "0") {
              ?><div class="form-group">
                  <div class="alert alert-success alert-dismissible">
                    <?php echo $note ?>
                  </div>
                </div><?php
                    } else if ($alert == "1") {
                      ?><div class="form-group">
                  <div class="alert alert-danger alert-dismissible">
                    <?php echo $note ?>
                  </div>
                </div><?php
                    }
                      ?>

              <div class="card card-primary">
                <div class="card-header">
                  <h4>Login</h4>
                </div>

                <div class="card-body">
                  <form method="POST" autocomplete="off" class="needs-validation" novalidate="">
                    <div class="form-group">
                      <label for="userid">User ID</label>
                      <input id="userid" type="text" class="form-control" name="userid" tabindex="1" required autofocus>
                      <div class="invalid-feedback">
                        silahkan isi user id anda
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="d-block">
                        <label for="password" class="control-label">Password</label>

                      </div>
                      <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                      <div class="invalid-feedback">
                        silahkan isi password anda
                      </div>
                    </div>



                    <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="chk"  value="1" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->


                    <div class="form-group">
                      <button type="submit" name="signin" value="signin" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                      </button>

                  </form>


                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- General JS Scripts -->
    <!--  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->

    <script src="assets/js/stisla.js"></script>


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/moment.min.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
  </body>

  </html>