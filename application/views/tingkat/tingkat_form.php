<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TINGKAT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Tingkat <?php echo form_error('nama_tingkat') ?></td><td><input type="text" class="form-control" name="nama_tingkat" id="nama_tingkat" placeholder="Nama Tingkat" value="<?php echo $nama_tingkat; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="tingkat_id" value="<?php echo $tingkat_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('tingkat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>