<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SISWA</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">            
        </div>
            </div>
            <div class='col-md-3'>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll; ">
        <form action="<?= base_url() ?>siswa/update_kelas/<?= $kelas_id ?>" method="POST">
            <div style="display: inline-block; width:20%;" class="form-group">
                                <label for="tanggal" class="control-label">Pindahkan Siswa</label>
                                <select name="kelas_id" class="form-control" required="">
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($kelas as $key => $data) { ?>
                                    <option value="<?php echo $data->kelas_id ?>"><?php echo $data->nama_kelas ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" ><i class="fa fa-save" aria-hidden="true"></i> Update</button>
                                <a style="float: right;" href="<?= base_url('siswa/grup') ?>" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
        <table class="table table-bordered" id="table3">
            <thead>
            <tr>
                <th>No</th>
                <th><input type='checkbox' id='checkAll' > Cek All</th>
                <th>Nis</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Nama Ibu</th>
                <th>Nama Ayah</th>
                <th>No Hp Wali Murid</th>
                <th>Action</th>
            </tr>
            </thead><?php
            foreach ($siswa_data as $siswa)
            {
                ?>
                <tr>
            <td width="10px"><?php echo ++$start ?></td>
            <td><input type="checkbox" name="update[]" value="<?= $siswa->siswa_id ?>"></td>
            <td><?php echo $siswa->nis ?></td>
            <td><?php echo $siswa->nama_siswa ?></td>
            <td><?php echo $siswa->jenis_kelamin ?></td>
            <td><?php echo $siswa->nama_ibu ?></td>
            <td><?php echo $siswa->nama_ayah ?></td>
            <td><?php echo $siswa->no_hp_wali_murid ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('siswa/read/'.$siswa->siswa_id.'/'.$kelas_id),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
                echo '  '; 
                echo anchor(site_url('siswa/update/'.$siswa->siswa_id.'/'.$kelas_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
                echo '  '; 
                echo anchor(site_url('siswa/delete/'.$siswa->siswa_id.'/'.$kelas_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        </form>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="update[]"]').prop('checked',true);
    }else{
      $('input[name="update[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="update[]"]').click(function(){
    var total_checkboxes = $('input[name="update[]"]').length;
    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>