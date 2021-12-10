<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                     <div class="box-header with-border">
               
               <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                <i class="fa fa-info-circle"></i> Nama Siswa : <b><?php echo $siswa['nama_siswa'] ?></b>
                </div>
            </div>   
        
        <div class="box-body">       
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll; ">

          <input type="hidden" name="siswa_id"  id="siswa_id" value="<?php echo $siswa['siswa_id'] ?>">
          <input type="hidden" name="tahun_ajaran_id"  id="tahun_ajaran_id" value="<?= $this->uri->segment(4) ?>">
          <input type="hidden" name="semester"  id="semester" value="<?= $this->uri->segment(5) ?>">

    <table class='table table-bordered'>
    <tr>
      <td class="text-center">
        Daftar Surah
      </td>
      <td class="text-center">Surah Sudah DiTambahan</td>
    </tr>      
              <tr>
                <td width="50%">
                  <div id="daftar_surat"></div>
                </td>
                <td width="50%">
                  <div id="sudah_tertempel"></div>
                </td>
                  
              </tr>
    </table>

        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    var siswa_id = $("#siswa_id").val();
    var tahun_ajaran_id = $("#tahun_ajaran_id").val();
    var semester = $("#semester").val();

    $.ajax({
           url:"<?php echo base_url(); ?>surat_siswa/daftar_surat",
           method:"POST",
           data:{siswa_id:siswa_id,tahun_ajaran_id:tahun_ajaran_id,semester:semester},
           success:function(data){
            $('#daftar_surat').html(data);
           }
          })

    $.ajax({
           url:"<?php echo base_url(); ?>surat_siswa/sudah_tertempel",
           method:"POST",
           data:{siswa_id:siswa_id,tahun_ajaran_id:tahun_ajaran_id,semester:semester},
           success:function(data){
            $('#sudah_tertempel').html(data);
           }
          })
  });
</script>