<!-- Main content -->
<div class="content-wrapper">
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <center>

          <div class="box-body box-profile">

            <?php if ($this->fungsi->user_login()->photo =='default.jpg') { ?>
              <a href="#modal-dialog" data-bs-toggle="modal"><img style="width: 150px;height: 150px;border-radius: 5%;" src="<?php echo base_url().'/admin/assets/img/sal.jpg' ?>" /></a>
            <?php }else{ ?>
              <a href="#modal-dialog" data-bs-toggle="modal"><img style="width: 150px;height: 150px;border-radius: 5%;" src="<?php echo base_url().'/admin/assets/img/user/'.$this->fungsi->user_login()->photo ?>" /></a>
            <?php } ?>

            <h3 class="profile-username text-center"><?= ucfirst($this->fungsi->user_login()->username) ?></h3>
            <p class="text-muted text-center"><?= $this->fungsi->user_login()->level ?>
            </p>
          </div>

          </center>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Edit Profile</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="<?php echo base_url() ?>pannel_siswa/edit_password/<?= $this->fungsi->user_login()->user_id ?>" enctype="multipart/form-data" role="form" method="post">
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username*</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" placeholder="Username" readonly="" value="<?= $this->fungsi->user_login()->username ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="lama" name="lama" placeholder="Old Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">New Password</label>
                  <div class="col-sm-10">
                    <input id="password" class="form-control" name="password" type="password" pattern="^\S{5,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 5 Karakter' : ''); if(this.checkValidity()) form.passcon.pattern = this.value;" placeholder="Password Baru" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Verify Password</label>
                  <div class="col-sm-10">
                    <input class="form-control" id="passcon" name="passcon" type="password" pattern="^\S{5,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="Verify Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>


            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
</div>