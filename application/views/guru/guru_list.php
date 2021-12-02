<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <a href="files/Format Import Guru.xlsx"><i class="fa fa-file-pdf-o faa-pulse animated"></i> &nbsp;Download Format Import Guru</a>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('guru/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('guru/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
      <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_add_new"> Import Data</a>         
        </div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('guru/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('guru'); ?>" class="btn btn-default">Reset</a>
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
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll;">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        		<th>Nip</th>
        		<th>Nama Guru</th>
        		<th>Jenis Kelamin</th>
        		<th>Alamat</th>
                <th>Akses Kelompok</th>
        		<th>Action</th>
            </tr>
            <?php
            foreach ($guru_data as $guru) { ?>
                <tr>
        			<td width="10px"><?php echo ++$start ?></td>
        			<td><?php echo $guru->nip ?></td>
        			<td><?php echo $guru->nama_guru ?></td>
        			<td><?php echo $guru->jenis_kelamin ?></td>
        			<td><?php echo $guru->alamat ?></td>
                    <td style="text-align:center"><a href="<?= base_url() ?>guru/akses_kelompok/<?php echo $guru->guru_id ?>" class="btn btn-success btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i>Lihat Akses</a></td>
        			<td style="text-align:center" width="200px">
        				<?php 
        				echo anchor(site_url('guru/read/'.$guru->guru_id),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
        				echo '  '; 
        				echo anchor(site_url('guru/update/'.$guru->guru_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
        				echo '  '; 
        				echo anchor(site_url('guru/delete/'.$guru->guru_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
        				?>
        			</td>
        		</tr>
            <?php } ?>
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

<!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Data Guru</h3>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>import/import">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">File Upload</label>
                    <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required="">
                </div>
                <input type="submit" class="btn btn-primary" value="Import" name="import" />
            </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->