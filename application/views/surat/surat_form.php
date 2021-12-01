<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SURAT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Surat <?php echo form_error('nama_surat') ?></td><td><input type="text" class="form-control" name="nama_surat" id="nama_surat" placeholder="Nama Surat" value="<?php echo $nama_surat; ?>" /></td></tr>
	    <tr><td width='200'>Jumlah Ayat <?php echo form_error('jumlah_ayat') ?></td><td><input type="text" class="form-control" name="jumlah_ayat" id="jumlah_ayat" placeholder="Jumlah Ayat" value="<?php echo $jumlah_ayat; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="surat_id" value="<?php echo $surat_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('surat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>