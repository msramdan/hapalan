
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
              .warna{
                color: #FF0000;
              }
            </style>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Absen </title>
    <link href="<?php echo base_url() ?>assets/user/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/user/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/user/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/user/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/user/build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?php echo base_url();?>assets/js/dataflash.js"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo base_url(); ?>user_absen/login/loginsubmit" method="post">
              <h1>Login Form</h1>
              <div>
                <input name="kd_karyawan" type="text" class="form-control" placeholder="Kode Karyawan" required="" />
              </div>
              
              <div>
                <input name="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
<!--                 <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>STMIK BINA INSANI</h1>
                  <p>Copyright ©2020 STMIK BINA INSANI - All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="<?php echo base_url(); ?>Login/simpan_user" method="post" enctype="multipart/form-data">
              <h1>Create Account</h1>
              <div>
                <input name="kd_karyawan" type="text" class="form-control" placeholder="kd_karyawan" required="" minlength="5" maxlength="10" />
              </div>
              <div>
                <input name="nama_karyawan" type="text" class="form-control" placeholder="Nama Lengkap" required="" />
              </div>
              <div>
                <input name="email" type="email" class="form-control" placeholder="email" required="" />
              </div>
              <div>
                <input id="password" class="form-control" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.passcon.pattern = this.value;" placeholder="Password" required>
              </div>
              <div>
                <input class="form-control" id="passcon" name="passcon" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="Verify Password" required>    
              </div>
              <div>
                <input name="img_user" type="file" class="form-control" required="" />
              </div><br>
                <div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
              </div>
            
              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>
                <div class="clearfix"></div>
                <br />

                 <div>
                  <h1>STMIK BINA INSANI</h1>
                  <p>Copyright ©2020 STMIK BINA INSANI - All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?php echo base_url();?>assets/js/dataflash.js"></script>