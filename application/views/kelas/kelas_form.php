<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KELAS</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        
	    <tr>
            <td width='200'>Tingkat <?php echo form_error('tingkat_id') ?></td>
            <td><select name="tingkat_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($tingkat as $key => $data) { ?>
                  <?php if ($tingkat_id == $data->tingkat_id) { ?>
                    <option value="<?php echo $data->tingkat_id ?>" selected><?php echo $data->nama_tingkat ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->tingkat_id ?>"><?php echo $data->nama_tingkat ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>


	    <tr><td width='200'>Nama Kelas <?php echo form_error('nama_kelas') ?></td><td><input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" value="<?php echo $nama_kelas; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kelas_id" value="<?php echo $kelas_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('tingkat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>