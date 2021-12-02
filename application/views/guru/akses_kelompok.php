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
                <i class="fa fa-info-circle"></i> Akses Kelompok : <b><?php echo $guru['nama_guru'] ?></b>
                </div>
            </div>   
        
        <div class="box-body">       
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll; ">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Tahun Ajaran</th>
                <th>Kelompok</th>
            </tr>
            <?php $no = 1; foreach ($Tahun_ajaran as $data) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $data->tahun_ajaran ?></td>
                    <td>
                        <?php
                            $queryKelompok = "SELECT * from kelompok where tahun_ajaran_id='$data->tahun_ajaran_id'";
                            $kelompok = $this->db->query($queryKelompok)->result();
                         ?>
                         <?php foreach ($kelompok as $k) : ?>
                            <input class="form-check-input" type="checkbox" <?= check_access($guru['guru_id'],$k->kelompok_id); ?>
                                    data-guru_id="<?= $guru['guru_id']; ?>"
                                    data-kelompok_id="<?= $k->kelompok_id ?>">
                                    <?= $k->nama_kelompok ?><br>
                        <?php endforeach ?>
                        

                    </td>
                </tr>
                <?php } ?>
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

    <script type="text/javascript">
      $('.form-check-input').on('click', function() {
        const guru_id = $(this).data('guru_id');
        const kelompok_id = $(this).data('kelompok_id');
        $.ajax({
          url: "<?= base_url('guru/changeaccess'); ?>",
          type: "post",
          data: {
            guru_id: guru_id,
            kelompok_id: kelompok_id,
          },
          success: function() {
            document.location.href = "<?= base_url('guru/akses_kelompok/') ?>" + guru_id;
          }

        });

      })
    </script>