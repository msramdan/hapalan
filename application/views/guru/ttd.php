<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">UPLOAD TANDA TANGAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered'>        

	    	<div class="form-group">
                    <tr>
                        <td>
                            <?php if ($tanda_tangan!=null || $tanda_tangan!='') { ?>
                                <a href="" data-bs-toggle="modal"><img  src="<?php echo base_url();?>admin/assets/img/ttd/<?=$tanda_tangan?>" style="width: 150px;height: 150px;border-radius: 5%;"></img></a>
                                
                            <?php } ?>
                            
                            <input type="hidden" name="tanda_tangan_lama" value="<?=$tanda_tangan?>">
                            <p style="color: red">Note :Pilih Tanda Tangan Jika Ingin Merubahnya</p>
                            <input type="file" class="form-control" name="tanda_tangan" id="tanda_tangan" placeholder="tanda_tangan" value="" onchange="return validasiEkstensi()" />
                        </td>
                    </tr>
                  </div>        

	    <tr><td><input type="hidden" name="guru_id" value="<?php echo $guru_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	</td></tr>
	</table></form>        </div>
</div>
</div>

<script type="text/javascript">
  function validasiEkstensi(){
    var inputFile = document.getElementById('tanda_tangan');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png');
        inputFile.value = '';
        return false;
    }else{
        // Preview tanda_tangan
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').innerHTML = '<iframe src="'+e.target.result+'" style="height:400px; width:600px"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
</script>
