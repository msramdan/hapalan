<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA GURU</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Nip <?php echo form_error('nip') ?></td><td><input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" /></td></tr>
	    <tr><td width='200'>Nama Guru <?php echo form_error('nama_guru') ?></td><td><input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Nama Guru" value="<?php echo $nama_guru; ?>" /></td></tr>
	    <tr>
            <td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td>
            <td><select name="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin ?>">
                <option value="">-- Pilih --</option>
                <option value="Laki Laki" <?php echo $jenis_kelamin == 'Laki Laki' ? 'selected' : 'null' ?>>Laki Laki</option>
                <option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : 'null' ?>>Perempuan</option>
              </select>
            </td>
          </tr>
        <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action') { ?>
          <?php
          $queryData = "SELECT user.*,guru.guru_id
                      FROM user
                      LEFT OUTER JOIN guru
                      ON user.user_id = guru.user_id
                      WHERE guru.guru_id IS NULL
                      and level='GURU'";
            $data_user = $this->db->query($queryData); ?>
            <tr>
                <td width='200'>User <?php echo form_error('user_id') ?></td>
                <td>
                  <select name="user_id" class="form-control">
                    <option value="">-- Pilih -- </option>
                    <?php foreach ($data_user->result() as $data) { ?>
                        <option value="<?php echo $data->user_id ?>"><?php echo $data->username ?></option>
                    <?php } ?>
                  </select>
                </td>
            </tr>          
        <?php }else{ ?>

          <?php
          $queryData = "SELECT user.*,guru.guru_id
                      FROM user
                      LEFT OUTER JOIN guru
                      ON user.user_id = guru.user_id
                      WHERE guru.guru_id IS NULL
                      and level='GURU' or user.user_id='$user_id'";
            $data_user = $this->db->query($queryData); ?>
          <tr>
            <td width='200'>User <?php echo form_error('user_id') ?></td>
            <td>
              <select name="user_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($data_user->result() as $data) { ?>
                  <?php if ($user_id == $data->user_id) { ?>
                    <option value="<?php echo $data->user_id ?>" selected><?php echo $data->username ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->user_id ?>"><?php echo $data->username ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </td>
          </tr>
        <?php } ?>    

	    <tr><td></td><td><input type="hidden" name="guru_id" value="<?php echo $guru_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('guru') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
