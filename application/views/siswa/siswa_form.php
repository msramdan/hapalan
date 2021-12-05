<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SISWA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'> 
  <input type="hidden" name="kelas_id_asal" value="<?= $this->uri->segment(4) ?>">      

	    <tr><td width='200'>Nis <?php echo form_error('nis') ?></td><td><input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" value="<?php echo $nis; ?>" /></td></tr>
	    <tr><td width='200'>Nama Siswa <?php echo form_error('nama_siswa') ?></td><td><input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" /></td></tr>
	    
	    <tr>
            <td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td>
            <td><select name="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin ?>">
                <option value="">-- Pilih --</option>
                <option value="Laki Laki" <?php echo $jenis_kelamin == 'Laki Laki' ? 'selected' : 'null' ?>>Laki Laki</option>
                <option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : 'null' ?>>Perempuan</option>
              </select>
            </td>
          </tr>

	    <tr>
            <td width='200'>Kelas <?php echo form_error('kelas_id') ?></td>
            <td><select name="kelas_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($kelas as $key => $data) { ?>
                  <?php if ($kelas_id == $data->kelas_id) { ?>
                    <option value="<?php echo $data->kelas_id ?>" selected><?php echo $data->nama_kelas ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->kelas_id ?>"><?php echo $data->nama_kelas ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>


	    <tr><td width='200'>Nama Ibu <?php echo form_error('nama_ibu') ?></td><td><input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?php echo $nama_ibu; ?>" /></td></tr>
	    <tr><td width='200'>Nama Ayah <?php echo form_error('nama_ayah') ?></td><td><input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" value="<?php echo $nama_ayah; ?>" /></td></tr>
	    <tr><td width='200'>No Hp Wali Murid <?php echo form_error('no_hp_wali_murid') ?></td><td><input type="text" class="form-control" name="no_hp_wali_murid" id="no_hp_wali_murid" placeholder="No Hp Wali Murid" value="<?php echo $no_hp_wali_murid; ?>" /></td></tr>

      <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action') { ?>
          <?php
          $queryData = "SELECT user.*,siswa.siswa_id
                      FROM user
                      LEFT OUTER JOIN siswa
                      ON user.user_id = siswa.user_id
                      WHERE siswa.siswa_id IS NULL
                      and level='SISWA'";
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
          $queryData = "SELECT user.*,siswa.siswa_id
                      FROM user
                      LEFT OUTER JOIN siswa
                      ON user.user_id = siswa.user_id
                      WHERE siswa.siswa_id IS NULL
                      and level='SISWA' or user.user_id='$user_id'";
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

	    <tr><td></td><td><input type="hidden" name="siswa_id" value="<?php echo $siswa_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('siswa?kelas_id=' .$this->uri->segment(4)) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>