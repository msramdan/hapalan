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
                <i class="fa fa-info-circle"></i> Anggota Kelompok : <b><?php echo $kelompok['nama_kelompok'] ?></b>
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
          <input type="hidden" name="tingkat_id"  id="tingkat_id" value="<?php echo $kelompok['tingkat_id'] ?>">
          <input type="hidden" name="kelompok_id"  id="kelompok_id" value="<?php echo $kelompok['kelompok_id'] ?>">

    <table class='table table-bordered'>
    <tr>
      <td class="text-center">
        Daftar Siswa
      </td>
      <td class="text-center">Anggota Member</td>
    </tr>      
              <tr>
                <td width="50%">
                  <div id="daftar_kelas"></div>
                </td>
                <td width="50%">
                  <div id="daftar_kelompok"></div>
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
    var tingkat_id = $("#tingkat_id").val();
    var kelompok_id = $("#kelompok_id").val();
    $.ajax({
           url:"<?php echo base_url(); ?>kelompok/daftar_kelas",
           method:"POST",
           data:{tingkat_id:tingkat_id,kelompok_id:kelompok_id},
           success:function(data){
            $('#daftar_kelas').html(data);
           }
          })

    $.ajax({
           url:"<?php echo base_url(); ?>kelompok/daftar_kelompok",
           method:"POST",
           data:{kelompok_id:kelompok_id},
           success:function(data){
            $('#daftar_kelompok').html(data);
           }
          })
  });
</script>