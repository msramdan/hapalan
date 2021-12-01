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
	    
        <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td></tr>
	    <tr><td width='200'>User Id <?php echo form_error('user_id') ?></td><td><input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="guru_id" value="<?php echo $guru_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('guru') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>