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
    </table>


        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

    <script type="text/javascript">
      $('.form-check-input').on('click', function() {
        const kelompok_id = $(this).data('kelompok_id');
        const kelompok_id = $(this).data('kelompok_id');
        $.ajax({
          url: "<?= base_url('kelompok/changeaccess'); ?>",
          type: "post",
          data: {
            kelompok_id: kelompok_id,
            kelompok_id: kelompok_id,
          },
          success: function() {
            document.location.href = "<?= base_url('kelompok/akses_kelompok/') ?>" + kelompok_id;
          }

        });

      })
    </script>