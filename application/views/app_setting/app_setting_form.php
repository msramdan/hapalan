<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA APP_SETTING</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Nama Aplikasi <?php echo form_error('nama_aplikasi') ?></td><td><input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" placeholder="Nama Aplikasi" value="<?php echo $nama_aplikasi; ?>" /></td></tr>
	    <tr><td width='200'>Nama Sekolah <?php echo form_error('nama_sekolah') ?></td><td><input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah" value="<?php echo $nama_sekolah; ?>" /></td></tr>
	    
        <tr><td width='200'>Alamat Sekolah <?php echo form_error('alamat_sekolah') ?></td><td> <textarea class="form-control" rows="3" name="alamat_sekolah" id="alamat_sekolah" placeholder="Alamat Sekolah"><?php echo $alamat_sekolah; ?></textarea></td></tr>
		<?php if ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'update_action' ) { ?>
	    	<div class="form-group">
                    <tr>
                        <td >Logo Sekolah <?php echo form_error('logo_sekolah') ?></td>
                        <td>
                            <a href="" data-bs-toggle="modal"><img  src="<?php echo base_url();?>admin/assets/img/sekolah/<?=$logo_sekolah?>" style="width: 150px;height: 150px;border-radius: 5%;"></img></a>
                            <input type="hidden" name="logo_sekolah_lama" value="<?=$logo_sekolah?>">
                            <p style="color: red">Note :Pilih Logo Sekolah Jika Ingin Merubahnya</p>
                            <input type="file" class="form-control" name="logo_sekolah" id="logo_sekolah" placeholder="logo_sekolah" value="" onchange="return validasiEkstensi()" />
                        </td>
                    </tr>
                  </div>
         <?php } ?>            

	    <tr><td width='200'>Kepala Sekolah <?php echo form_error('author') ?></td><td><input type="text" class="form-control" name="author" id="author" placeholder="Author" value="<?php echo $author; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	</td></tr>
	</table></form>        </div>
</div>
</div>