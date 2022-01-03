<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SURAT</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('surat/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('surat/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-upload" aria-hidden="true"></i> Import</a></div>
		
	</div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('surat/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('surat'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama Surat</th>
		<th>Jumlah Ayat</th>
		<th>Action</th>
            </tr><?php
            foreach ($surat_data as $surat)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $surat->nama_surat ?></td>
			<td><?php echo $surat->jumlah_ayat ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('surat/read/'.$surat->surat_id),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('surat/update/'.$surat->surat_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('surat/delete/'.$surat->surat_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','onclick="return confirm('."'Yakin Hapus Data ?'".')" class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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

<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Data Surah</h3>
                <a class="btn btn-success" href="files/Format Import Surah.xlsx"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Download Format Import Surah</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>import/surah">
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
