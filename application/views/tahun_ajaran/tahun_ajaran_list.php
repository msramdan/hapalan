<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA TAHUN_AJARAN</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('tahun_ajaran/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('tahun_ajaran/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('tahun_ajaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tahun_ajaran'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
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
        		<th>Status</th>
                <th>Semester</th>
        		<th>Action</th>
            </tr><?php
            foreach ($tahun_ajaran_data as $tahun_ajaran)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tahun_ajaran->tahun_ajaran ?></td>
            <?php
            if ($tahun_ajaran->status ==1) { ?>
                 <td>Aktif</td>
             <?php }else{ ?>
                <td>Non Aktif</td>
             <?php } ?>

            <td>
                        <?php
                            $queryKelompok = "SELECT * from tahun_ajaran_detail where tahun_ajaran_id='$tahun_ajaran->tahun_ajaran_id'";
                            $tahun_ajaran_detail = $this->db->query($queryKelompok)->result();
                         ?>
                         <?php foreach ($tahun_ajaran_detail as $t) : ?>
                            <input class="form-check-input" type="checkbox" <?= check_aktif_semester($t->tahun_ajaran_detail_id); ?>
                                    data-tahun_ajaran_detail_id="<?= $t->tahun_ajaran_detail_id ?>">Semester 
                                    <?= $t->semester ?><br>
                        <?php endforeach ?>
                        

            </td>
			
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tahun_ajaran/read/'.$tahun_ajaran->tahun_ajaran_id),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('tahun_ajaran/update/'.$tahun_ajaran->tahun_ajaran_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('tahun_ajaran/delete/'.$tahun_ajaran->tahun_ajaran_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','onclick="return confirm('."'Yakin Hapus Data ?'".')" class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>


    <script type="text/javascript">
      $('.form-check-input').on('click', function() {
        const tahun_ajaran_detail_id = $(this).data('tahun_ajaran_detail_id');
        $.ajax({
          url: "<?= base_url('tahun_ajaran/changeaktif'); ?>",
          type: "post",
          data: {
            tahun_ajaran_detail_id: tahun_ajaran_detail_id,
          },
          success: function() {
            document.location.href = "<?= base_url('tahun_ajaran') ?>"
          }

        });

      })
    </script>
